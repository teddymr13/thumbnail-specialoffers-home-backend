<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form id="form_system_settings" method="post">
                    <ul class="nav nav-tabs" id="form_tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general_tab" data-toggle="tab" href="#general_content" role="tab" aria-controls="general_content" aria-selected="true">Setting</a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link" id="thumbnailstore_tab" data-toggle="tab" href="#thumbnailstore_content" role="tab" aria-controls="thumbnailstore_content" aria-selected="false">Thumbnail Store</a>
                        </li>
                         <li class="nav-item">
                             <a class="nav-link" id="thumbnailbookshelf_tab" data-toggle="tab" href="#thumbnailbookshelf_content" role="tab" aria-controls="thumbnailbookshelf_content" aria-selected="false">Thumbnail Magazine </a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link" id="thumbnailnewsfeed_tab" data-toggle="tab" href="#thumbnailnewsfeed_content" role="tab" aria-controls="thumbnailnewsfeed_content" aria-selected="false">Thumbnail Newsfeed </a>
                        </li>
                        <li class="nav-item">
                             <a class="nav-link" id="thumbnailvoucher_tab" data-toggle="tab" href="#thumbnailvoucher_content" role="tab" aria-controls="thumbnailvoucher_content" aria-selected="false">Thumbnail Voucher </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="thumbnailspecialoffers_tab" data-toggle="tab" href="#thumbnailspecialoffers_content" role="tab" aria-controls="thumbnailspecialoffers_content" aria-selected="false">Thumbnail Special Offers </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="thumbnailadsbanner_tab" data-toggle="tab" href="#thumbnailadsbanner_content" role="tab" aria-controls="thumbnailadsbanner_content" aria-selected="false">Ads Banner</a>
                        </li>
                         
                    </ul>

                    <div class="tab-content pt-3" id="setting_tab_content product_tab_content">
                        <div class="tab-pane fade show active" id="general_content" role="tabpanel" aria-labelledby="general_tab">
                            <div class="form-group">
                                 <label for="company_name" class="label_required_field">Company Name</label>
                                 <input id="company_name" name="company_name" type="text" maxlength="65" class="form-control" value="<?php echo $info_per['nama_pt']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="name" class="label_required_field">Name / Brand</label>
                                <input id="name" name="name" type="text" maxlength="25" class="form-control" value="<?php echo $info_per['sebutan']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="title_text" class="label_required_field">Title Text</label>
                                <input id="title_text" name="title_text" type="text" maxlength="160" class="form-control" value="<?php echo $info_per['title_teks']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="short_description" class="label_required_field">Meta Tag Description / Short Description</label>
                                <textarea class="form-control" id="short_description" name="short_description" rows="3" required><?php echo $info_per['desp']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="keywords" class="label_required_field">Meta Tag Keywords</label>
                                <input id="keywords" name="keywords" type="text" maxlength="255" class="form-control" value="<?php echo $info_per['kkp']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="about" class="label_required_field">About RegistryE</label>
                                <textarea id="about" name="about" class="tinymce"><?php echo $info_per['about']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="about_two" class="label_required_field">About RegistryE Shop</label>
                                <textarea id="about_two" name="about_two" class="tinymce"><?php echo $info_per['about_two']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="address" class="label_required_field">Address</label>
                                <input id="address" name="address" type="text" maxlength="255" class="form-control" value="<?php echo $info_per['alamat']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="google_map">Google Map (href)</label>
                                <input id="google_map" name="google_map" type="url" maxlength="65535" class="form-control" value="<?php echo $info_per['google_map']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="telp" class="label_required_field">Telephone 1</label>
                                <input id="telp" name="telp" type="tel" maxlength="25" class="form-control" value="<?php echo $info_per['telp']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="fax">Telephone 2</label>
                                <input id="fax" name="fax" type="tel" maxlength="25" class="form-control" value="<?php echo $info_per['faks']; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="email" class="label_required_field">Email</label>
                                <input id="email" name="email" type="email" maxlength="150" class="form-control" value="<?php echo $info_per['email']; ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="paypal_account" class="label_required_field">PayPal Account (Email)</label>
                                <input id="paypal_account" name="paypal_account" type="email" maxlength="255" class="form-control" value="<?php echo $info_per['ppac']; ?>" required />
                            </div>
                        </div>
                        <!--thumbnail Product/Store For Home Page -->
                        <div class="tab-pane fade" id="thumbnailstore_content" role="tabpanel" aria-labelledby="thumbnailstore_tab">
                            <h5>Thumblnail Product/Store For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu store.and click save</small>

                            <table id="table_storehomme" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Judul Section Product</th>
                                    <th scope="col">Title Section Product</th>
                                    <th scope="col">Deksripsi Section Product</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_product) && is_array($deksripsi_product) && count($deksripsi_product) > 0){
                                        $i=0;
                                        foreach ($deksripsi_product as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_product_<?php echo $i; ?>" name="judul_section_product[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['judul_section_product']; ?>"/>
                                                </td>
                                                 <td>
                                                    <input id="title_section_product_<?php echo $i; ?>" name="title_section_product[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_product']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_product_<?php echo $i; ?>" name="deksripsi_section_product[]" type="text" maxlength="225" class="form-control" value="<?php echo $item['deksripsi_section_product']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_product_<?php echo $i; ?>" name="judul_section_product[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="title_section_product_<?php echo $i; ?>" name="title_section_product[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_product_<?php echo $i; ?>" name="deksripsi_section_product[]" type="text" maxlength="225" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <table id="table_storehome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Url Product</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_product) && is_array($data_product) && count($data_product) > 0){
                                        $i=0;
                                        foreach ($data_product as $item ){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_product_<?php echo $i; ?>" name="id_product[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_product']; ?>"/>
                                                </td>
                                                 <td>
                                                    <input id="url_product_<?php echo $i; ?>" name="url_product[]" type="url" maxlength="225" class="form-control" value="<?php echo $item['url_product']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_product_<?php echo $i; ?>" name="id_product[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="url_product_<?php echo $i; ?>" name="url_product[]" type="text" maxlength="225" class="form-control"/>
                                                </td>
        
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_storehome">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>
                            <!-- form part row 2 -->
                            <h5>Thumblnail Product/Store Row two For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu store.and click save</small>

                            <table id="table_storehomerowtwoss" class="table table-bordered">
                                <thead>
                                <tr>
                                   
                                    <th scope="col">Title Section Product</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_productrowtwo) && is_array($deksripsi_productrowtwo) && count($deksripsi_productrowtwo) > 0){
                                        $i=0;
                                        foreach ($deksripsi_productrowtwo as $item ){
                                            $i++;
                                            ?>
                                            <tr>
                                               
                                                 <td>
                                                    <input id="title_section_productrowtwo_<?php echo $i; ?>" name="title_section_productrowtwo[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_productrowtwo']; ?>"/>
                                                </td>
                                               
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                               
                                                <td>
                                                    <input id="title_section_productrowtwo_<?php echo $i; ?>" name="title_section_productrowtwo[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <table id="table_storehomerowtwo" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Url Product</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_productrowtwo) && is_array($data_productrowtwo) && count($data_productrowtwo) > 0){
                                        $i=0;
                                        foreach ( $data_productrowtwo as $item ){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_productrowtwo_<?php echo $i; ?>" name="id_productrowtwo[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_productrowtwo']; ?>"/>
                                                </td>
                                                 <td>
                                                    <input id="url_productrowtwo_<?php echo $i; ?>" name="url_productrowtwo[]" type="url" maxlength="225" class="form-control" value="<?php echo $item['url_productrowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_productrowtwo_<?php echo $i; ?>" name="id_productrowtwo[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="url_productrowtwo_<?php echo $i; ?>" name="url_productrowtwo[]" type="text" maxlength="225" class="form-control"/>
                                                </td>
        
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_storehomerowtwo">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>  
                        </div>
                      
                        <!--thumbnail BOOKSHELF For Home Page -->
                          <div class="tab-pane fade" id="thumbnailbookshelf_content" role="tabpanel" aria-labelledby="thumbnailbookshelf_tab">
                            <h5>Thumblnail Bookshelf/Magazine For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu store.and click save</small>
                            
                            <table id="table_magazinehomme" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Judul Section Magazine</th>
                                    <th scope="col">Title Section Magazine</th>
                                    <th scope="col">Deksripsi Section Magazine</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_magazine) && is_array($deksripsi_magazine) && count($deksripsi_magazine) > 0){
                                        $i=0;
                                        foreach ($deksripsi_magazine as $item ){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_magazine_<?php echo $i; ?>" name="judul_section_magazine[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['judul_section_magazine']; ?>"/>
                                                </td>
                                                 <td>
                                                    <input id="title_section_magazine_<?php echo $i; ?>" name="title_section_magazine[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_magazine']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_magazine_<?php echo $i; ?>" name="deksripsi_section_magazine[]" type="text" maxlength="225" class="form-control" value="<?php echo $item['deksripsi_section_magazine']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_magazine_<?php echo $i; ?>" name="judul_section_magazine[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="title_section_magazine_<?php echo $i; ?>" name="title_section_magazine[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_magazine_<?php echo $i; ?>" name="deksripsi_section_magazine[]" type="text" maxlength="225" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                          
                            <table id="table_magazinehome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Magazine ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_magazine) && is_array($data_magazine) && count($data_magazine) > 0){
                                        $i=0;
                                        foreach ($data_magazine as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_magazine_<?php echo $i; ?>" name="id_magazine[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_magazine']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_magazine_<?php echo $i; ?>" name="id_magazine[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_magazinehome">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div> 
                            <!-- row two magazine -->
                            <h5>Thumblnail Bookshelf/Magazine For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu store.and click save</small>
                            <table id="table_magazinehomme" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Title Section Magazine</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_magazinerowtwo) && is_array($deksripsi_magazinerowtwo) && count($deksripsi_magazinerowtwo) > 0){
                                        $i=0;
                                        foreach ($deksripsi_magazinerowtwo as $item ){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="title_section_magazinerowtwo_<?php echo $i; ?>" name="title_section_magazinerowtwo[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_magazinerowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                               
                                                <td>
                                                    <input id="title_section_magazinerowtwo_<?php echo $i; ?>" name="title_section_magazinerowtwo[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                    
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                             <table id="table_magazinerowtwohome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Magazine ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_magazinerowtwo) && is_array($data_magazinerowtwo) && count($data_magazinerowtwo) > 0){
                                        $i=0;
                                        foreach ($data_magazinerowtwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_magazinerowtwo_<?php echo $i; ?>" name="id_magazinerowtwo[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_magazinerowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_magazinerowtwo_<?php echo $i; ?>" name="id_magazinerowtwo[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_magazinerowtwohome">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>
                        </div>
                        <!--thumbnail NEWSFEED For Home Page -->
                        <div class="tab-pane fade" id="thumbnailnewsfeed_content" role="tabpanel" aria-labelledby="thumbnailnewsfeed_tab">
                            <h5>Thumblnail Newsfeed For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu store.and click save</small>
                            <table id="table_articlehomme" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Judul Section Article</th>
                                    <th scope="col">Title Section Article</th>
                                    <th scope="col">Deksripsi Section Article</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_article) && is_array($deksripsi_article) && count($deksripsi_article) > 0){
                                        $i=0;
                                        foreach ($deksripsi_article as $item ){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_article_<?php echo $i; ?>" name="judul_section_article[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['judul_section_article']; ?>"/>
                                                </td>
                                                 <td>
                                                    <input id="title_section_article_<?php echo $i; ?>" name="title_section_article[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_article']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_article_<?php echo $i; ?>" name="deksripsi_section_article[]" type="text" maxlength="225" class="form-control" value="<?php echo $item['deksripsi_section_article']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_article_<?php echo $i; ?>" name="judul_section_article[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="title_section_article_<?php echo $i; ?>" name="title_section_article[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_article_<?php echo $i; ?>" name="deksripsi_section_article[]" type="text" maxlength="225" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                          
                            <table id="table_articlehome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Article ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_article) && is_array($data_article) && count($data_article) > 0){
                                        $i=0;
                                        foreach ($data_article as $item ){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_article_<?php echo $i; ?>" name="id_article[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_article']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_article_<?php echo $i; ?>" name="id_article[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_newsfeedhome">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>

                            <!-- Row Two -->
                            <h5>Thumblnail Newsfeed For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu store.and click save</small>
                            <table id="table_articlerowtwohomee" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Title Section Article</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_articlerowtwo) && is_array($deksripsi_articlerowtwo) && count($deksripsi_articlerowtwo) > 0){
                                        $i=0;
                                        foreach ($deksripsi_articlerowtwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                 <td>
                                                    <input id="title_section_articlerowtwo_<?php echo $i; ?>" name="title_section_articlerowtwo[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_articlerowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="title_section_articlerowtwo_<?php echo $i; ?>" name="title_section_articlerowtwo[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <table id="table_articlerowtwohome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Article ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_articlerowtwo) && is_array($data_articlerowtwo) && count($data_articlerowtwo) > 0){
                                        $i=0;
                                        foreach ($data_articlerowtwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_articlerowtwo_<?php echo $i; ?>" name="id_articlerowtwo[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_articlerowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_articlerowtwo_<?php echo $i; ?>" name="id_articlerowtwo[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_newsfeedrowtwohome">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>
                        </div>
                        <!--thumbnail Voucher For Home Page -->
                        <div class="tab-pane fade" id="thumbnailvoucher_content" role="tabpanel" aria-labelledby="thumbnailvoucher_tab">
                            <h5>Thumblnail Voucher For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu Voucher.and click save</small>
                             <table id="table_voucherhomme" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Judul Section Voucher</th>
                                    <th scope="col">Title Section Voucher</th>
                                    <th scope="col">Deksripsi Section Voucher</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_voucher) && is_array($deksripsi_voucher) && count($deksripsi_voucher) > 0){
                                        $i=0;
                                        foreach ($deksripsi_voucher as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_voucher_<?php echo $i; ?>" name="judul_section_voucher[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['judul_section_voucher']; ?>"/>
                                                </td>
                                                 <td>
                                                    <input id="title_section_voucher_<?php echo $i; ?>" name="title_section_voucher[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_voucher']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_voucher_<?php echo $i; ?>" name="deksripsi_section_voucher[]" type="text" maxlength="225" class="form-control" value="<?php echo $item['deksripsi_section_voucher']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_voucher_<?php echo $i; ?>" name="judul_section_voucher[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="title_section_voucher_<?php echo $i; ?>" name="title_section_voucher[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_voucher_<?php echo $i; ?>" name="deksripsi_section_voucher[]" type="text" maxlength="225" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <table id="table_voucherhome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col"> VOUCHER ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_voucher) && is_array($data_voucher) && count($data_voucher) > 0){
                                        $i=0;
                                        foreach ($data_voucher as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_voucher_<?php echo $i; ?>" name="id_voucher[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_voucher']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_voucher_<?php echo $i; ?>" name="id_voucher[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_voucherhome">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div> 
                            <!-- Row Two -->
                            <h5>Thumblnail Voucher For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu store.and click save</small>
                            <table id="table_voucherhomerowtwohomee" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Title Section Article</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_voucherrowtwo) && is_array($deksripsi_voucherrowtwo) && count($deksripsi_voucherrowtwo) > 0){
                                        $i=0;
                                        foreach ($deksripsi_voucherrowtwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                 <td>
                                                    <input id="title_section_voucherrowtwo_<?php echo $i; ?>" name="title_section_voucherrowtwo[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_voucherrowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="title_section_voucherrowtwo_<?php echo $i; ?>" name="title_section_voucherrowtwo[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <table id="table_voucherhomerowtwohome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">VOUCHER ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_voucherrowtwo) && is_array($data_voucherrowtwo) && count($data_voucherrowtwo) > 0){
                                        $i=0;
                                        foreach ($data_voucherrowtwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_voucherrowtwo_<?php echo $i; ?>" name="id_voucherrowtwo[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_voucherrowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_voucherrowtwo_<?php echo $i; ?>" name="id_voucherrowtwo[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_voucherhomerowtwo">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>
                        </div>
                        <!--thumbnail SPECIAL OFFERS For Home Page -->
                        <div class="tab-pane fade" id="thumbnailspecialoffers_content" role="tabpanel" aria-labelledby="thumbnailspecialoffers_tab">
                            <h5>Thumblnail Special Offers For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu Special Offers.and click save</small>
                             <table id="table_specialoffershomme" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Judul Section Special Offers</th>
                                    <th scope="col">Title Section Special Offers</th>
                                    <th scope="col">Deksripsi Section Special Offers</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_specialoffers) && is_array($deksripsi_specialoffers) && count($deksripsi_specialoffers) > 0){
                                        $i=0;
                                        foreach ($deksripsi_specialoffers as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_specialoffers_<?php echo $i; ?>" name="judul_section_specialoffers[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['judul_section_specialoffers']; ?>"/>
                                                </td>
                                                 <td>
                                                    <input id="title_section_specialoffers_<?php echo $i; ?>" name="title_section_specialoffers[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_specialoffers']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_specialoffers_<?php echo $i; ?>" name="deksripsi_section_specialoffers[]" type="text" maxlength="225" class="form-control" value="<?php echo $item['deksripsi_section_specialoffers']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="judul_section_specialoffers_<?php echo $i; ?>" name="judul_section_specialoffers[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="title_section_specialoffers_<?php echo $i; ?>" name="title_section_specialoffers[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                                <td>
                                                    <input id="deksripsi_section_specialoffers_<?php echo $i; ?>" name="deksripsi_section_specialoffers[]" type="text" maxlength="225" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <table id="table_specialoffershome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col"> SPECIAL OFFERS ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_specialoffers) && is_array($data_specialoffers) && count($data_specialoffers) > 0){
                                        $i=0;
                                        foreach ($data_specialoffers as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_specialoffers_<?php echo $i; ?>" name="id_specialoffers[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_specialoffers']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_specialoffers_<?php echo $i; ?>" name="id_specialoffers[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_specialoffershome">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div> 
                            <!-- Row Two -->
                            <h5>Thumblnail Voucher For Home Page</h5>
                            <small class="form-text text-muted">To add more slide, click the &plus; Add Row Button.<br/>And add id from menu Special Offers.and click save</small>
                            <table id="table_specialoffershomerowtwohomee" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Title Section Special Offers</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($deksripsi_specialoffersrowtwo) && is_array($deksripsi_specialoffersrowtwo) && count($deksripsi_specialoffersrowtwo) > 0){
                                        $i=0;
                                        foreach ($deksripsi_specialoffersrowtwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                 <td>
                                                    <input id="title_section_specialoffersrowtwo_<?php echo $i; ?>" name="title_section_specialoffersrowtwo[]" type="text" maxlength="150" class="form-control" value="<?php echo $item['title_section_specialoffersrowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="title_section_specialoffersrowtwo_<?php echo $i; ?>" name="title_section_specialoffersrowtwo[]" type="text" maxlength="150" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <table id="table_specialoffershomerowtwohome" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">SPECIAL OFFERS ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($data_specialoffersrowtwo) && is_array($data_specialoffersrowtwo) && count($data_specialoffersrowtwo) > 0){
                                        $i=0;
                                        foreach ($data_specialoffersrowtwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_specialoffersrowtwo_<?php echo $i; ?>" name="id_specialoffersrowtwo[]" type="text" maxlength="10" class="form-control" value="<?php echo $item['id_specialoffersrowtwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=3; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="id_specialoffersrowtwo_<?php echo $i; ?>" name="id_specialoffersrowtwo[]" type="text" maxlength="10" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_specialoffershomerowtwo">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>
                        </div>
                       <!--Thumbnail Ads Banners-->
                        <div class="tab-pane fade" id="thumbnailadsbanner_content" role="tabpanel" aria-labelledby="thumbnailadsbanner_tab">
                            <!-- <h5>Ads Banner Header</h5> 
                            <table id="table_adsbannerone" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col"> Url Picture Header</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /*if(isset($bennersadds) && is_array($bennersadds) && count($bennersadds) > 0){
                                        $i=0;
                                        foreach ($bennersadds as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbr_<?php echo $i; ?>" name="url_gbr[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbr']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbr_<?php echo $i; ?>" name="url_gbr[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }*/
                                    ?>
                                </tbody>
                            </table>-->
                              <!-- <input type="hidden" id="count_row" name="count_row" value="<?php //echo $i; ?>" />  -->
                            <!-- <div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerone">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>--> 
                            <!-- Row Two -->
                            <!-- <h5>Ads Banner Body</h5> 
                            <table id="table_adsbannertwo" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture Body</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /*if(isset($bennersaddsbody) && is_array($bennersaddsbody) && count($bennersaddsbody) > 0){
                                        $i=0;
                                        foreach ($bennersaddsbody as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsbody_<?php echo $i; ?>" name="url_gbradsbody[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbradsbody']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsbody_<?php echo $i; ?>" name="url_gbradsbody[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }*/
                                    ?>
                                </tbody>
                            </table>-->
                              <!-- <input type="hidden" id="count_row" name="count_row" value="<?php //echo $i; ?>" />  -->
                            <!-- <div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannertwo">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>-->
                            <!-- Row Three -->
                            <!-- <h5>Ads Banner Footer</h5> 
                            <table id="table_adsbannerthree" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture Footer</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /*if(isset($bennersaddsfooter) && is_array($bennersaddsfooter) && count($bennersaddsfooter) > 0){
                                        $i=0;
                                        foreach ($bennersaddsfooter as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsfooter_<?php echo $i; ?>" name="url_gbradsfooter[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbradsfooter']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsfooter_<?php echo $i; ?>" name="url_gbradsfooter[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }*/
                                    ?>
                                </tbody>
                            </table>-->
                            <!-- <input type="hidden" id="count_row" name="count_row" value="<?php //echo $i; ?>" />  -->
                            <!-- <div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerthree">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>-->
                            <!--layer2-->
                            <h5>Banner Leaderboard Ads</h5>
                            <table id="table_adsbannerheadertwo" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                    <th scope="col">link Ads</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($bennersaddsheadertwo) && is_array($bennersaddsheadertwo) && count($bennersaddsheadertwo) > 0){
                                        $i=0;
                                        foreach ($bennersaddsheadertwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsheadertwo_<?php echo $i; ?>" name="url_gbradsheadertwo[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbradsheadertwo']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkadsheadertwo_<?php echo $i; ?>" name="url_linkadsheadertwo[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkadsheadertwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsheadertwo_<?php echo $i; ?>" name="url_gbradsheadertwo[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkadsheadertwo_<?php echo $i; ?>" name="url_linkadsheadertwo[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- <input type="hidden" id="count_row" name="count_row" value="<?php //echo $i; ?>" />  -->
                            <!-- <div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerheadertwo">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>-->
                            <h5>Banner Middle Ads </h5>
                            <table id="table_adsbannerbodytwo" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                     <th scope="col">link Ads</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($bennersaddsbodytwo) && is_array($bennersaddsbodytwo) && count($bennersaddsbodytwo) > 0){
                                        $i=0;
                                        foreach ($bennersaddsbodytwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsbodytwo_<?php echo $i; ?>" name="url_gbradsbodytwo[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbradsbodytwo']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkadsbodytwo_<?php echo $i; ?>" name="url_linkadsbodytwo[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkadsbodytwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsbodytwo_<?php echo $i; ?>" name="url_gbradsbodytwo[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkadsbodytwo_<?php echo $i; ?>" name="url_linkadsbodytwo[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- <input type="hidden" id="count_row" name="count_row" value="<?php //echo $i; ?>" />  -->
                            <!-- <div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerbodytwo">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>-->
                           
                            <!-- <h5>Ads Banner Side</h5> 
                            <table id="table_adsbannerside" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                    <th scope="col">link Picture</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    /*if(isset($bennersaddsside) && is_array($bennersaddsside) && count($bennersaddsside) > 0){
                                        $i=0;
                                        foreach($bennersaddsside as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsside_<?php echo $i; ?>" name="url_gbradsside[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbradsside']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkadsside_<?php echo $i; ?>" name="url_linkadsside[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkadsside']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsside_<?php echo $i; ?>" name="url_gbradsside[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkadsside_<?php echo $i; ?>" name="url_linkadsside[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }*/
                                    ?>
                                </tbody>
                            </table>-->
                              <!-- <input type="hidden" id="count_row" name="count_row" value="<?php //echo $i; ?>" />  -->
                            <!--<div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerside">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>-->
                            <h5>Banner Bottom Ads (Home Page)</h5>
                            <table id="table_adsbannerfthomepage" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                    <th scope="col">link Ads</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($bennersaddsfthomepage) && is_array($bennersaddsfthomepage) && count($bennersaddsfthomepage) > 0){
                                        $i=0;
                                        foreach($bennersaddsfthomepage as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsfthomepage_<?php echo $i; ?>" name="url_gbradsfthomepage[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbradsfthomepage']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkadsfthomepage_<?php echo $i; ?>" name="url_linkadsfthomepage[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkadsfthomepage']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsfthomepage_<?php echo $i; ?>" name="url_gbradsfthomepage[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkadsfthomepage_<?php echo $i; ?>" name="url_linkadsfthomepage[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsfthomepage">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>

                            <h5>Banner Hanging Bottom Ads</h5>
                            <table id="table_adsbannerfootertwo" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                    <th scope="col">link Ads</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($bennersaddsfootertwo) && is_array($bennersaddsfootertwo) && count($bennersaddsfootertwo) > 0){
                                        $i=0;
                                        foreach($bennersaddsfootertwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsfootertwo_<?php echo $i; ?>" name="url_gbradsfootertwo[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbradsfootertwo']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkadsfootertwo_<?php echo $i; ?>" name="url_linkadsfootertwo[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkadsfootertwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsfootertwo_<?php echo $i; ?>" name="url_gbradsfootertwo[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkadsfootertwo_<?php echo $i; ?>" name="url_linkadsfootertwo[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- <input type="hidden" id="count_row" name="count_row" value="<?php //echo $i; ?>" />  -->
                            <!-- <div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerfootertwo">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>-->
                            <h5>Banner Bottom Ads (Detail Page)</h5>
                            <table id="table_adsbannerdetailpage" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                    <th scope="col">link Ads</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($bennersaddsdetailpage) && is_array($bennersaddsdetailpage) && count($bennersaddsdetailpage) > 0){
                                        $i=0;
                                        foreach($bennersaddsdetailpage as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsdetailpage_<?php echo $i; ?>" name="url_gbradsdetailpage[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbradsdetailpage']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkadsdetailpage_<?php echo $i; ?>" name="url_linkadsdetailpage[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkadsdetailpage']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbradsdetailpage_<?php echo $i; ?>" name="url_gbradsdetailpage[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkadsdetailpage_<?php echo $i; ?>" name="url_linkadsdetailpage[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerdetailpage">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>
                            <!--layer2-->

                            <h5>Banner Ads Slider Option Satu </h5>
                            <table id="table_adsbannerslidertwo" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                    <th scope="col">link Ads</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($bennersaddsslidertwo) && is_array($bennersaddsslidertwo) && count($bennersaddsslidertwo) > 0){
                                        $i=0;
                                        foreach($bennersaddsslidertwo as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbrslidertwo_<?php echo $i; ?>" name="url_gbrslidertwo[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbrslidertwo']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkslidertwo_<?php echo $i; ?>" name="url_linkslidertwo[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkslidertwo']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbrslidertwo_<?php echo $i; ?>" name="url_gbrslidertwo[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkslidertwo_<?php echo $i; ?>" name="url_linkslidertwo[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                              <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerslidertwo">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>


                            <h5>Banner Ads Slider Option Kedua</h5>
                            <table id="table_adsbannerslider" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                    <th scope="col">link Ads</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($bennersaddsslider) && is_array($bennersaddsslider) && count($bennersaddsslider) > 0){
                                        $i=0;
                                        foreach($bennersaddsslider as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbrslider_<?php echo $i; ?>" name="url_gbrslider[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbrslider']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkslider_<?php echo $i; ?>" name="url_linkslider[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkslider']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbrslider_<?php echo $i; ?>" name="url_gbrslider[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkslider_<?php echo $i; ?>" name="url_linkslider[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <input type="hidden" id="count_row" name="count_row" value="<?php echo $i; ?>" /> 
                            <div align="right">
                                <button type="button" class="btn btn-secondary" id="button_add_row_adsbannerslider">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>


                            <h5>Banner Ads PopUp</h5>
                            <table id="table_adspopup" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Url Picture</th>
                                    <th scope="col">link Ads</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($bennersaddspopup) && is_array($bennersaddspopup) && count($bennersaddspopup) > 0){
                                        $i=0;
                                        foreach($bennersaddspopup as $item){
                                            $i++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbrpopup_<?php echo $i; ?>" name="url_gbrpopup[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_gbrpopup']; ?>"/>
                                                </td>
                                                <td>
                                                    <input id="url_linkspopup_<?php echo $i; ?>" name="url_linkspopup[]" type="url" maxlength="255" class="form-control" value="<?php echo $item['url_linkspopup']; ?>"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else {
                                        for($i=1; $i<=1; $i++){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input id="url_gbrpopup_<?php echo $i; ?>" name="url_gbrpopup[]" type="url" maxlength="255" class="form-control"/>
                                                </td>

                                                <td>
                                                    <input id="url_linkspopup_<?php echo $i; ?>" name="url_linkspopup[]" type="url" maxlength="255" class="form-control"/>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- <input type="hidden" id="count_row" name="count_row" value="<?php //echo $i; ?>" />  -->
                            <!-- <div align="right"> 
                                <button type="button" class="btn btn-secondary" id="button_add_row_adspopup">
                                    &plus;<span class="d-none d-lg-inline-block">&nbsp;Add Row</span>
                                </button>
                            </div>-->
                        </div>
                       <!-- End Thumnaild Ads Banners -->
                       
                    </div>
                     <?php $isEdit = true; require_once 'views/includes/form-submit-buttons.php'; ?>
                </form>
            </div>
        </div>
    </div>
</div>