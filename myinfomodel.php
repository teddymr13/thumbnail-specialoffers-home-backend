<?php
class MyInfoModel extends Model {
    public function getInfo(){
        $this->query("SELECT nama_pt, sebutan, title_teks, desp, kkp, about, about_two, alamat, google_map, telp, faks, email, ppac FROM info_perusahaan WHERE id = 1");
        return $this->resultSingle();
    }
    public function updateInfo($set, $param = NULL, $sql_str = "UPDATE info_perusahaan"){
        return $this->basicQueryUpdate($set, $param, $sql_str);
    }
    public function getSocialMedia(){
        $this->query("SELECT nama, icon_class, url, urut FROM social_media WHERE url <> '' ORDER BY urut");
        return $this->resultSet();
    }
    public function deleteSocialMedia($param = NULL, $sql_str = "DELETE FROM social_media"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertSocialMedia($icon_class, $nama, $url, $order){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url); $i++){
            if(!empty($url[$i]) && !empty($icon_class[$i]) && !empty($nama[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:name".$i.", :icon".$i.", :url".$i.", :order".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO social_media (nama, icon_class, url, urut) VALUES " . $str_values);
            for($i = 0; $i < count($url); $i++){
                if(!empty($url[$i]) && !empty($icon_class[$i]) && !empty($nama[$i])){
                    if(empty($order[$i])) $order[$i] = $i + 1;
                    $this->bind(":name".$i, $nama[$i]);
                    $this->bind(":icon".$i, $icon_class[$i]);
                    $this->bind(":url".$i, $url[$i]);
                    $this->bind(":order".$i, $order[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
    // MODEL PRODUCT
    // Row One
    public function getProductHome(){
        $this->query("SELECT id_product, url_product FROM home_product_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteProductHome($param = NULL, $sql_str = "DELETE FROM home_product_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertProductHome($id_product, $url_product){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_product); $i++){
            if(!empty($url_product[$i]) && !empty($id_product[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_product".$i.", :url_product".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_product_thumbnail (id_product, url_product) VALUES " . $str_values);
            for($i = 0; $i < count($url_product); $i++){
                if(!empty($url_product[$i]) && !empty($id_product[$i])){
                    $this->bind(":id_product".$i, $id_product[$i]);
                    $this->bind(":url_product".$i, $url_product[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getDeksripsiProduct(){
        $this->query("SELECT judul_section_product, title_section_product, deksripsi_section_product FROM deksripsi_product_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiProduct($param = NULL, $sql_str = "DELETE FROM deksripsi_product_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiProduct($judul_section_product, $title_section_product, $deksripsi_section_product){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_product); $i++){
            if(!empty($title_section_product[$i]) && !empty($judul_section_product[$i]) && !empty($deksripsi_section_product[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:judul_section_product".$i.", :title_section_product".$i.", :deksripsi_section_product".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_product_thumbnail (judul_section_product, title_section_product, deksripsi_section_product) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_product); $i++){
                if(!empty($title_section_product[$i]) && !empty($judul_section_product[$i]) && !empty($deksripsi_section_product[$i])){
                    $this->bind(":judul_section_product".$i, $judul_section_product[$i]);
                    $this->bind(":title_section_product".$i, $title_section_product[$i]);
                    $this->bind(":deksripsi_section_product".$i, $deksripsi_section_product[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
    // Row Two
    public function getProductRowTwoHome(){
        $this->query("SELECT id_productrowtwo, url_productrowtwo FROM home_productrowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }

    public function deleteProductRowTwoHome($param = NULL, $sql_str = "DELETE FROM home_productrowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }

    public function insertProductRowTwoHome($id_productrowtwo, $url_productrowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_productrowtwo); $i++){
            if(!empty($url_productrowtwo[$i]) && !empty($id_productrowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_productrowtwo".$i.", :url_productrowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_productrowtwo_thumbnail (id_productrowtwo, url_productrowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($url_productrowtwo); $i++){
                if(!empty($url_productrowtwo[$i]) && !empty($id_productrowtwo[$i])){
                    $this->bind(":id_productrowtwo".$i, $id_productrowtwo[$i]);
                    $this->bind(":url_productrowtwo".$i, $url_productrowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getDeksripsiProductRowTwo(){
        $this->query("SELECT title_section_productrowtwo FROM deskripsi_productrowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiProductRowTwo($param = NULL, $sql_str = "DELETE FROM deskripsi_productrowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiProductRowTwo($title_section_productrowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_productrowtwo); $i++){
            if(!empty($title_section_productrowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:title_section_productrowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deskripsi_productrowtwo_thumbnail (title_section_productrowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_productrowtwo); $i++){
                if(!empty($title_section_productrowtwo[$i])){
                    $this->bind(":title_section_productrowtwo".$i, $title_section_productrowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
    // END MODEL PRODUCT

    // MODEL MAGAZINE
    public function getMagazineHome(){
        $this->query("SELECT id_magazine FROM home_magazine_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteMagazineHome($param = NULL, $sql_str = "DELETE FROM home_magazine_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertMagazineHome($id_magazine){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($id_magazine); $i++){
            if(!empty($id_magazine[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_magazine".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_magazine_thumbnail (id_magazine) VALUES " . $str_values);
            for($i = 0; $i < count($id_magazine); $i++){
                if(!empty($id_magazine[$i])){
                    $this->bind(":id_magazine".$i, $id_magazine[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getDeksripsiMagazine(){
        $this->query("SELECT judul_section_magazine, title_section_magazine, deksripsi_section_magazine FROM deksripsi_magazine_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiMagazine($param = NULL, $sql_str = "DELETE FROM deksripsi_magazine_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiMagazine($judul_section_magazine, $title_section_magazine, $deksripsi_section_magazine){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_magazine); $i++){
            if(!empty($title_section_magazine[$i]) && !empty($judul_section_magazine[$i]) && !empty($deksripsi_section_magazine[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:judul_section_magazine".$i.", :title_section_magazine".$i.", :deksripsi_section_magazine".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_magazine_thumbnail (judul_section_magazine, title_section_magazine, deksripsi_section_magazine) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_magazine); $i++){
                if(!empty($title_section_magazine[$i]) && !empty($judul_section_magazine[$i]) && !empty($deksripsi_section_magazine[$i])){
                    $this->bind(":judul_section_magazine".$i, $judul_section_magazine[$i]);
                    $this->bind(":title_section_magazine".$i, $title_section_magazine[$i]);
                    $this->bind(":deksripsi_section_magazine".$i, $deksripsi_section_magazine[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    // rowtwo
    public function getMagazineRowTwoHome(){
        $this->query("SELECT id_magazinerowtwo FROM home_magazinerowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteMagazineRowTwoHome($param = NULL, $sql_str = "DELETE FROM home_magazinerowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }

    public function insertMagazineRowTwoHome($id_magazinerowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($id_magazinerowtwo); $i++){
            if(!empty($id_magazinerowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_magazinerowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_magazinerowtwo_thumbnail (id_magazinerowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($id_magazinerowtwo); $i++){
                if(!empty($id_magazinerowtwo[$i])){
                    $this->bind(":id_magazinerowtwo".$i, $id_magazinerowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getDeksripsiMagazineRowTwo(){
        $this->query("SELECT title_section_magazinerowtwo FROM deksripsi_magazinerowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiMagazineRowTwo($param = NULL, $sql_str = "DELETE FROM deksripsi_magazinerowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }

    public function insertDeksripsiMagazineRowTwo($title_section_magazinerowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_magazinerowtwo); $i++){
            if(!empty($title_section_magazinerowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:title_section_magazinerowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_magazinerowtwo_thumbnail (title_section_magazinerowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_magazinerowtwo); $i++){
                if(!empty($title_section_magazinerowtwo[$i])){
                    $this->bind(":title_section_magazinerowtwo".$i, $title_section_magazinerowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
    // END MODEL MAGAZINE

    // MODEL NEWSFEED
    public function getNewsfeedHome(){
        $this->query("SELECT id_article FROM home_article_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteNewsfeedHome($param = NULL, $sql_str = "DELETE FROM home_article_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertNewsfeedHome($id_article){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($id_article); $i++){
            if(!empty($id_article[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_article".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_article_thumbnail (id_article) VALUES " . $str_values);
            for($i = 0; $i < count($id_article); $i++){
                if(!empty($id_article[$i])){
                    $this->bind(":id_article".$i, $id_article[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getDeksripsiNewsfeed(){
        $this->query("SELECT judul_section_article, title_section_article, deksripsi_section_article FROM deksripsi_article_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiNewsfeed($param = NULL, $sql_str = "DELETE FROM deksripsi_article_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiNewsfeed($judul_section_article, $title_section_article, $deksripsi_section_article){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_article); $i++){
            if(!empty($title_section_article[$i]) && !empty($judul_section_article[$i]) && !empty($deksripsi_section_article[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:judul_section_article".$i.", :title_section_article".$i.", :deksripsi_section_article".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_article_thumbnail (judul_section_article, title_section_article, deksripsi_section_article) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_article); $i++){
                if(!empty($title_section_article[$i]) && !empty($judul_section_article[$i]) && !empty($deksripsi_section_article[$i])){
                    $this->bind(":judul_section_article".$i, $judul_section_article[$i]);
                    $this->bind(":title_section_article".$i, $title_section_article[$i]);
                    $this->bind(":deksripsi_section_article".$i, $deksripsi_section_article[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    // row two
    public function getNewsfeedRowTwoHome(){
        $this->query("SELECT id_articlerowtwo FROM home_articlerowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteNewsfeedRowTwoHome($param = NULL, $sql_str = "DELETE FROM home_articlerowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertNewsfeedRowTwoHome($id_articlerowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($id_articlerowtwo); $i++){
            if(!empty($id_articlerowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_articlerowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_articlerowtwo_thumbnail (id_articlerowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($id_articlerowtwo); $i++){
                if(!empty($id_articlerowtwo[$i])){
                    $this->bind(":id_articlerowtwo".$i, $id_articlerowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getDeksripsiNewsfeedRowTwo(){
        $this->query("SELECT title_section_articlerowtwo FROM deksripsi_articlerowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiNewsfeedRowTwo($param = NULL, $sql_str = "DELETE FROM deksripsi_articlerowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiNewsfeedRowTwo($title_section_articlerowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_articlerowtwo); $i++){
            if(!empty($title_section_articlerowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:title_section_articlerowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_articlerowtwo_thumbnail (title_section_articlerowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_articlerowtwo); $i++){
                if(!empty($title_section_articlerowtwo[$i])){
                    $this->bind(":title_section_articlerowtwo".$i, $title_section_articlerowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
   
    // END MODEL NEWSFEED

    // MODEL vOUCHER
    public function getVoucherHome(){
        $this->query("SELECT id_voucher FROM home_voucher_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteVoucherHome($param = NULL, $sql_str = "DELETE FROM home_voucher_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertVoucherHome($id_voucher){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($id_voucher); $i++){
            if(!empty($id_voucher[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_voucher".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_voucher_thumbnail (id_voucher) VALUES " . $str_values);
            for($i = 0; $i < count($id_voucher); $i++){
                if(!empty($id_voucher[$i])){
                    $this->bind(":id_voucher".$i, $id_voucher[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getDeksripsiVoucher(){
        $this->query("SELECT judul_section_voucher, title_section_voucher, deksripsi_section_voucher FROM deksripsi_voucher_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiVoucher($param = NULL, $sql_str = "DELETE FROM deksripsi_voucher_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiVoucher($judul_section_voucher, $title_section_voucher, $deksripsi_section_voucher){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_voucher); $i++){
            if(!empty($title_section_voucher[$i]) && !empty($judul_section_voucher[$i]) && !empty($deksripsi_section_voucher[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:judul_section_voucher".$i.", :title_section_voucher".$i.", :deksripsi_section_voucher".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_voucher_thumbnail (judul_section_voucher, title_section_voucher, deksripsi_section_voucher) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_voucher); $i++){
                if(!empty($title_section_voucher[$i]) && !empty($judul_section_voucher[$i]) && !empty($deksripsi_section_voucher[$i])){
                    $this->bind(":judul_section_voucher".$i, $judul_section_voucher[$i]);
                    $this->bind(":title_section_voucher".$i, $title_section_voucher[$i]);
                    $this->bind(":deksripsi_section_voucher".$i, $deksripsi_section_voucher[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    // row two
    public function getVoucherRowTwoHome(){
        $this->query("SELECT id_voucherrowtwo FROM home_voucherrowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteVoucherRowTwoHome($param = NULL, $sql_str = "DELETE FROM home_voucherrowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertVoucherRowTwoHome($id_voucherrowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($id_voucherrowtwo); $i++){
            if(!empty($id_voucherrowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_voucherrowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_voucherrowtwo_thumbnail (id_voucherrowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($id_voucherrowtwo); $i++){
                if(!empty($id_voucherrowtwo[$i])){
                    $this->bind(":id_voucherrowtwo".$i, $id_voucherrowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
    public function getDeksripsiVoucherrowtwo(){
        $this->query("SELECT title_section_voucherrowtwo FROM deksripsi_voucherrowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiVoucherrowtwo($param = NULL, $sql_str = "DELETE FROM deksripsi_voucherrowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiVoucherrowtwo($title_section_voucherrowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_voucherrowtwo); $i++){
            if(!empty($title_section_voucherrowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:title_section_voucherrowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_voucherrowtwo_thumbnail (title_section_voucherrowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_voucherrowtwo); $i++){
                if(!empty($title_section_voucherrowtwo[$i])){
                    $this->bind(":title_section_voucherrowtwo".$i, $title_section_voucherrowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
    // END MODEL VOUCHER


     //MODEL SPECIALOFFERS
    public function getSpecialOffersHome(){
        $this->query("SELECT id_specialoffers FROM home_specialoffers_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteSpecialOffersHome($param = NULL, $sql_str = "DELETE FROM home_specialoffers_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertSpecialOffersHome($id_specialoffers){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($id_specialoffers); $i++){
            if(!empty($id_specialoffers[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_specialoffers".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_specialoffers_thumbnail (id_specialoffers) VALUES " . $str_values);
            for($i = 0; $i < count($id_specialoffers); $i++){
                if(!empty($id_specialoffers[$i])){
                    $this->bind(":id_specialoffers".$i, $id_specialoffers[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getDeksripsiSpecialOffers(){
        $this->query("SELECT judul_section_specialoffers, title_section_specialoffers, deksripsi_section_specialoffers FROM deksripsi_specialoffers_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiSpecialOffers($param = NULL, $sql_str = "DELETE FROM deksripsi_specialoffers_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiSpecialOffers($judul_section_specialoffers, $title_section_specialoffers, $deksripsi_section_specialoffers){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_specialoffers); $i++){
            if(!empty($title_section_specialoffers[$i]) && !empty($judul_section_specialoffers[$i]) && !empty($deksripsi_section_specialoffers[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:judul_section_specialoffers".$i.", :title_section_specialoffers".$i.", :deksripsi_section_specialoffers".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_specialoffers_thumbnail (judul_section_specialoffers, title_section_specialoffers, deksripsi_section_specialoffers) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_specialoffers); $i++){
                if(!empty($title_section_specialoffers[$i]) && !empty($judul_section_specialoffers[$i]) && !empty($deksripsi_section_specialoffers[$i])){
                    $this->bind(":judul_section_specialoffers".$i, $judul_section_specialoffers[$i]);
                    $this->bind(":title_section_specialoffers".$i, $title_section_specialoffers[$i]);
                    $this->bind(":deksripsi_section_specialoffers".$i, $deksripsi_section_specialoffers[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    // row two
    public function getSpecialOffersRowTwoHome(){
        $this->query("SELECT id_specialoffersrowtwo FROM home_specialoffersrowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteSpecialOffersRowTwoHome($param = NULL, $sql_str = "DELETE FROM home_specialoffersrowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertSpecialOffersRowTwoHome($id_specialoffersrowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($id_specialoffersrowtwo); $i++){
            if(!empty($id_specialoffersrowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:id_specialoffersrowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO home_specialoffersrowtwo_thumbnail (id_specialoffersrowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($id_specialoffersrowtwo); $i++){
                if(!empty($id_specialoffersrowtwo[$i])){
                    $this->bind(":id_specialoffersrowtwo".$i, $id_specialoffersrowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
    public function getDeksripsiSpecialOffersrowtwo(){
        $this->query("SELECT title_section_specialoffersrowtwo FROM deksripsi_specialoffersrowtwo_thumbnail WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteDeksripsiSpecialOffersrowtwo($param = NULL, $sql_str = "DELETE FROM deksripsi_specialoffersrowtwo_thumbnail"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertDeksripsiSpecialOffersrowtwo($title_section_specialoffersrowtwo){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($title_section_specialoffersrowtwo); $i++){
            if(!empty($title_section_specialoffersrowtwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:title_section_specialoffersrowtwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO deksripsi_specialoffersrowtwo_thumbnail (title_section_specialoffersrowtwo) VALUES " . $str_values);
            for($i = 0; $i < count($title_section_specialoffersrowtwo); $i++){
                if(!empty($title_section_specialoffersrowtwo[$i])){
                    $this->bind(":title_section_specialoffersrowtwo".$i, $title_section_specialoffersrowtwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    //END MODEL SPECIALOFFERS

    // ads
    public function getAdsBenner(){
        $this->query("SELECT url_gbr FROM ads_registrye WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBenner($param = NULL, $sql_str = "DELETE FROM ads_registrye"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBenner($url_gbr){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_gbr); $i++){
            if(!empty($url_gbr[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbr".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye (url_gbr) VALUES " . $str_values);
            for($i = 0; $i < count($url_gbr); $i++){
                if(!empty($url_gbr[$i])){
                    $this->bind(":url_gbr".$i, $url_gbr[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    /*public function getAdsBennerBody(){
        $this->query("SELECT url_gbradsbody FROM ads_registrye_body WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }*/
    /*public function deleteAdsBennerBody($param = NULL, $sql_str = "DELETE FROM ads_registrye_body"){
        return $this->basicQueryDelete($param, $sql_str);
    }*/
    /*public function insertAdsBennerBody($url_gbradsbody){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_gbradsbody); $i++){
            if(!empty($url_gbradsbody[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbradsbody".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_body (url_gbradsbody) VALUES " . $str_values);
            for($i = 0; $i < count($url_gbradsbody); $i++){
                if(!empty($url_gbradsbody[$i])){
                    $this->bind(":url_gbradsbody".$i, $url_gbradsbody[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }*/

    /*public function getAdsBennerFooter(){
        $this->query("SELECT url_gbradsfooter FROM ads_registrye_footer WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }*/
    /*public function deleteAdsBennerFooter($param = NULL, $sql_str = "DELETE FROM ads_registrye_footer"){
        return $this->basicQueryDelete($param, $sql_str);
    }*/
    /*public function insertAdsBennerFooter($url_gbradsfooter){
        $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_gbradsfooter); $i++){
            if(!empty($url_gbradsfooter[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbradsfooter".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_footer (url_gbradsfooter) VALUES " . $str_values);
            for($i = 0; $i < count($url_gbradsfooter); $i++){
                if(!empty($url_gbradsfooter[$i])){
                    $this->bind(":url_gbradsfooter".$i, $url_gbradsfooter[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }*/

    public function getAdsBennerHeadertwo(){
        $this->query("SELECT url_gbradsheadertwo, url_linkadsheadertwo FROM ads_registrye_headertwo WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBennerHeadertwo($param = NULL, $sql_str = "DELETE FROM ads_registrye_headertwo"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBennerHeadertwo($url_gbradsheadertwo, $url_linkadsheadertwo){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkadsheadertwo); $i++){
            if(!empty($url_linkadsheadertwo[$i]) && !empty($url_gbradsheadertwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbradsheadertwo".$i.", :url_linkadsheadertwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_headertwo (url_gbradsheadertwo, url_linkadsheadertwo) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkadsheadertwo); $i++){
                if(!empty($url_linkadsheadertwo[$i]) && !empty($url_gbradsheadertwo[$i])){
                    $this->bind(":url_gbradsheadertwo".$i, $url_gbradsheadertwo[$i]);
                    $this->bind(":url_linkadsheadertwo".$i, $url_linkadsheadertwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getAdsBennerBodytwo(){
        $this->query("SELECT url_gbradsbodytwo, url_linkadsbodytwo FROM ads_registrye_bodytwo WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBennerBodytwo($param = NULL, $sql_str = "DELETE FROM ads_registrye_bodytwo"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBennerBodytwo($url_gbradsbodytwo, $url_linkadsbodytwo){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkadsbodytwo); $i++){
            if(!empty($url_linkadsbodytwo[$i]) && !empty($url_gbradsbodytwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbradsbodytwo".$i.", :url_linkadsbodytwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_bodytwo (url_gbradsbodytwo, url_linkadsbodytwo) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkadsbodytwo); $i++){
                if(!empty($url_linkadsbodytwo[$i]) && !empty($url_gbradsbodytwo[$i])){
                    $this->bind(":url_gbradsbodytwo".$i, $url_gbradsbodytwo[$i]);
                    $this->bind(":url_linkadsbodytwo".$i, $url_linkadsbodytwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }


    public function getAdsBennerFootertwo(){
        $this->query("SELECT url_gbradsfootertwo, url_linkadsfootertwo FROM ads_registrye_footertwo WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBennerFootertwo($param = NULL, $sql_str = "DELETE FROM ads_registrye_footertwo"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBennerFootertwo($url_gbradsfootertwo, $url_linkadsfootertwo){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkadsfootertwo); $i++){
            if(!empty($url_linkadsfootertwo[$i]) && !empty($url_gbradsfootertwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbradsfootertwo".$i.", :url_linkadsfootertwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_footertwo (url_gbradsfootertwo, url_linkadsfootertwo) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkadsfootertwo); $i++){
                if(!empty($url_linkadsfootertwo[$i]) && !empty($url_gbradsfootertwo[$i])){
                    $this->bind(":url_gbradsfootertwo".$i, $url_gbradsfootertwo[$i]);
                    $this->bind(":url_linkadsfootertwo".$i, $url_linkadsfootertwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }


    /*public function getAdsBennerSide(){
        $this->query("SELECT url_gbradsside, url_linkadsside FROM ads_registrye_side WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }*/
    /*public function deleteAdsBennerSide($param = NULL, $sql_str = "DELETE FROM ads_registrye_side"){
        return $this->basicQueryDelete($param, $sql_str);
    }*/
    /*public function insertAdsBennerSide($url_gbradsside, $url_linkadsside){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkadsside); $i++){
            if(!empty($url_linkadsside[$i]) && !empty($url_gbradsside[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbradsside".$i.", :url_linkadsside".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_side (url_gbradsside, url_linkadsside) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkadsside); $i++){
                if(!empty($url_linkadsside[$i]) && !empty($url_gbradsside[$i])){
                    $this->bind(":url_gbradsside".$i, $url_gbradsside[$i]);
                    $this->bind(":url_linkadsside".$i, $url_linkadsside[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }*/

    public function getAdsBennerDetailPage(){
        $this->query("SELECT url_gbradsdetailpage, url_linkadsdetailpage FROM ads_registrye_detailpage WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBennerDetailPage($param = NULL, $sql_str = "DELETE FROM ads_registrye_detailpage"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBennerDetailPage($url_gbradsdetailpage, $url_linkadsdetailpage){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkadsdetailpage); $i++){
            if(!empty($url_linkadsdetailpage[$i]) && !empty($url_gbradsdetailpage[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbradsdetailpage".$i.", :url_linkadsdetailpage".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_detailpage (url_gbradsdetailpage, url_linkadsdetailpage) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkadsdetailpage); $i++){
                if(!empty($url_linkadsdetailpage[$i]) && !empty($url_gbradsdetailpage[$i])){
                    $this->bind(":url_gbradsdetailpage".$i, $url_gbradsdetailpage[$i]);
                    $this->bind(":url_linkadsdetailpage".$i, $url_linkadsdetailpage[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getAdsBennerfthomepage(){
        $this->query("SELECT url_gbradsfthomepage, url_linkadsfthomepage FROM ads_registrye_fthomepage WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBennerfthomepage($param = NULL, $sql_str = "DELETE FROM ads_registrye_fthomepage"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBennerfthomepage($url_gbradsfthomepage, $url_linkadsfthomepage){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkadsfthomepage); $i++){
            if(!empty($url_linkadsfthomepage[$i]) && !empty($url_gbradsfthomepage[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbradsfthomepage".$i.", :url_linkadsfthomepage".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_fthomepage (url_gbradsfthomepage, url_linkadsfthomepage) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkadsfthomepage); $i++){
                if(!empty($url_linkadsfthomepage[$i]) && !empty($url_gbradsfthomepage[$i])){
                    $this->bind(":url_gbradsfthomepage".$i, $url_gbradsfthomepage[$i]);
                    $this->bind(":url_linkadsfthomepage".$i, $url_linkadsfthomepage[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }


    public function getAdsBennerslider(){
        $this->query("SELECT url_gbrslider, url_linkslider FROM ads_registrye_slider WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBennerslider($param = NULL, $sql_str = "DELETE FROM ads_registrye_slider"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBennerslider($url_gbrslider, $url_linkslider){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkslider); $i++){
            if(!empty($url_linkslider[$i]) && !empty($url_gbrslider[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbrslider".$i.", :url_linkslider".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_slider (url_gbrslider, url_linkslider) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkslider); $i++){
                if(!empty($url_linkslider[$i]) && !empty($url_gbrslider[$i])){
                    $this->bind(":url_gbrslider".$i, $url_gbrslider[$i]);
                    $this->bind(":url_linkslider".$i, $url_linkslider[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getAdsBennerslidertwo(){
        $this->query("SELECT url_gbrslidertwo, url_linkslidertwo FROM ads_registrye_slidertwo WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBennerslidertwo($param = NULL, $sql_str = "DELETE FROM ads_registrye_slidertwo"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBennerslidertwo($url_gbrslidertwo, $url_linkslidertwo){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkslidertwo); $i++){
            if(!empty($url_linkslidertwo[$i]) && !empty($url_gbrslidertwo[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbrslidertwo".$i.", :url_linkslidertwo".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_slidertwo (url_gbrslidertwo, url_linkslidertwo) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkslidertwo); $i++){
                if(!empty($url_linkslidertwo[$i]) && !empty($url_gbrslidertwo[$i])){
                    $this->bind(":url_gbrslidertwo".$i, $url_gbrslidertwo[$i]);
                    $this->bind(":url_linkslidertwo".$i, $url_linkslidertwo[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }

    public function getAdsBennerPopup(){
        $this->query("SELECT url_gbrpopup, url_linkspopup FROM ads_registrye_popup WHERE id <> '' ORDER BY id");
        return $this->resultSet();
    }
    public function deleteAdsBennerPopup($param = NULL, $sql_str = "DELETE FROM ads_registrye_popup"){
        return $this->basicQueryDelete($param, $sql_str);
    }
    public function insertAdsBennerPopup($url_gbrpopup, $url_linkspopup){
       $str_values = '';
        $write_comma = false;
        for($i = 0; $i < count($url_linkspopup); $i++){
            if(!empty($url_linkspopup[$i]) && !empty($url_gbrpopup[$i])){
                if($write_comma) $str_values .= ", ";
                else $write_comma = true;

                $str_values .= "(:url_gbrpopup".$i.", :url_linkspopup".$i.")";
            }
        }

        if(!empty($str_values)){
            $this->query("INSERT INTO ads_registrye_popup (url_gbrpopup, url_linkspopup) VALUES " . $str_values);
            for($i = 0; $i < count($url_linkspopup); $i++){
                if(!empty($url_linkspopup[$i]) && !empty($url_gbrpopup[$i])){
                    $this->bind(":url_gbrpopup".$i, $url_gbrpopup[$i]);
                    $this->bind(":url_linkspopup".$i, $url_linkspopup[$i]);
                }
            }
            return $this->execute();
        }
        else return true;
    }
    // tutup ads



}