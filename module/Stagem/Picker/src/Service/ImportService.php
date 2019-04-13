<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2018 Stagem Team
 * This source file is subject to The MIT License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @category Stagem
 * @package Stagem_Customer
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\Picker\Service;

use Doctrine\ORM\QueryBuilder;
use Popov\Db\Db;
use Popov\ZfcCore\Service\DomainServiceAbstract;

/**
 * @method CustomerRepository getRepository()
 */
class ImportService extends DomainServiceAbstract
{
    /**
     * @var Db
     */
    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    protected $mediaparkGroupId = [
        2,
        111,
        210,
    ];

    public function import($userData)
    {
        $pdo = $this->db->getPdo();
        $rows = [];
        foreach ($userData['data'] as $data) {
            if ($data['enabled'] != 0 && in_array($data['project_group_id'], $this->mediaparkGroupId)) {
                $row = [];
                $row['email'] = $data['username'];
                $row['firstName'] = $data['first_name'];
                $row['lastName'] = $data['last_name'];
                $row['createdAt'] = $data['created'];
                $row['password'] = '84862b7574a0bc370277c63c6d6eaacc';
                $row['isInner'] = '1';

                $phones = explode(';', $data['phone']);
                $row['phone'] = preg_replace('/\D/', '', $phones[0]);
                if ($phones[1]) {
                    $row['phoneInternal'] = preg_replace('/\D/', '', $phones[1]);
                }

                if (strlen($row['phone']) > 13) {
                    var_dump($row);
                }
                $row['photo'] = $data['photo']['250x250'];
                $post = [];
                $post['skype'] = $data['skype'];
                $post['occupation'] = $data['occupation'];
                $post['project_group_id'] = $data['project_group_id'];
                $row['post'] = json_encode($post);
                $rows[] = $row;
            }
        }

        $this->db->multipleSave('user', $rows);

        echo 1;
    }

    public function updateTable()
    {
        $pdo = $this->db->getPdo();
        $marketplaceQuery = $pdo->query('SELECT id, code FROM amazon_marketplace', $pdo::FETCH_ASSOC);
        $marketplaces = $marketplaceQuery->fetchAll($pdo::FETCH_ASSOC);
        $tempMarketplace = [];
        foreach ($marketplaces as $key => $value) {
            $tempMarketplace[$value['code']] = $value['id'];
        }
        $productQuery = $pdo->query('SELECT id, asin FROM amazon_product', $pdo::FETCH_ASSOC);
        $products = $productQuery->fetchAll($pdo::FETCH_ASSOC);
        $tempProduct = [];
        foreach ($products as $key => $value) {
            $tempProduct[$value['asin']] = $value['id'];
        }
        $end = $pdo->query('SELECT COUNT(*) as count FROM amazon_product_history')->fetchColumn();
        $count = 0;
        $limit = 10000;
        $offset = 0;
        while ($offset < $end) {
            $res =
                $pdo->query("SELECT * FROM amazon_product_history LIMIT {$limit} OFFSET {$offset}", $pdo::FETCH_ASSOC);
            $rows = $res->fetchAll($pdo::FETCH_ASSOC);
            foreach ($rows as $i => $row) {
                //$productKey = array_search($row['asin'], array_column($products, 'asin'));
                if ($row['asin']) {
                    $row['productId'] = $tempProduct[$row['asin']];
                } else {
                    $row['productId'] = null;
                }
                //$marketplaceKey = array_search($row['marketplaceCode'], array_column($marketplaces, 'code'));
                if ($row['marketplaceCode']) {
                    $row['marketplaceId'] = $tempMarketplace[$row['marketplaceCode']];
                } else {
                    $row['marketplaceId'] = null;
                }
                $offset++;
                $rows[$i] = $row;
                $count++;
            }
            $this->db->multipleSave('amazon_product_history', $rows);
        }
    }
}