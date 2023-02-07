
<?php

            $id = $_GET['id'];
            $cart = $_SESSION['cart'];

            //berfungsi untuk mengambil data secara spesifik
            $k = array_filter($cart, function ($var) use ($id) {
                return ($var['id'] == $id);
            });
            // echo var_dump($k);
            foreach ($k as $key => $value) {
                unset($_SESSION['cart'][$key]);
            }

            //mengembalikan urutan data
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        
       header('location:?hal=detail_transaksi');
        ?>