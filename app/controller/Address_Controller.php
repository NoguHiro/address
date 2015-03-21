<?php
/**
 * Created by PhpStorm.
 * User: noguhiro
 * Date: 15/03/22
 * Time: 1:55
 */

class Address_Controller
{

    public function action_index()
    {
        $mAddress = new Address();
        $addresses = $mAddress->findAll();
//        foreach (range(0, 50) as $i) {
//            $mAddress->insert([
//                'name' => 'ゆうま' . $i,
//                'address' => '相模原市南区ゆうま' . $i,
//                'tel' => '090-1205-ゆうま' .$i
//            ]);
//        }
        View::load('index', compact('addresses'));
    }

    public function action_detail()
    {
        if (!isset($_GET['page'])) {
            throw new RuntimeException('該当するページが見つかりません');
        }
        $id = $_GET['page'];
        $mAddress = new Address();
        $address = $mAddress->findById($id);
        if (empty($address)) {
            throw new RuntimeException('該当するページが見つかりません');
        }
        View::load('detail', compact('address'));
    }

    public function action_create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach (['name', 'address', 'tel'] as $v) {
                if (!isset($_POST[$v])) {
                    throw new RuntimeException($v . 'がありません');
                }
            }
            $model = new Address();
            $model->insert([
                'name' => $_POST['name'],
                'address' => $_POST['address'],
                'tel' => $_POST['tel']
            ]);
            header("Location: ./");
        }
        View::load('create');
    }

    public function action_update()
    {

    }

    public function action_delete()
    {

    }
}