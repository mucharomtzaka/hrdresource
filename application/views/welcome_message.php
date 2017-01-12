<div class="content-wrapper"> 	
  <section class="content-header text-center">
     <font color="red"><?php echo $message;?></font>
    </section>
	<section class="content-body">
  <?php if(!$this->ion_auth->logged_in()){?>
		 <div class="box">
            <div class="row">
            <div class="col-md-12 text-center">
            <h1>Welcome to <?php echo $header_title;?>!</h1>
            <p><?php echo $header_title;?> merupakan sebuah aplikasi untuk melakukan manajemen Human Resourcing Development. Silahkan masukkan username dan password anda untuk mulai untuk melakukan manajemen atau pengolahan data kepegawaian sesuai dengan hak akses yang anda miliki.</p>
			        <p><a class="btn btn-primary btn-large">Pelajari Lebih Lanjut <i class="icon-circle-arrow-right icon-white"></i> </a></p>
            </div>
    </div>
<?php }else{?>
     <div class="box ">
      <div class="row">
        <div class="col-md-12 text-center">
            <h1>Welcome to <?php echo $header_title;?>!</h1>
            <p><?php echo $header_title;?> merupakan sebuah aplikasi untuk melakukan manajemen Human Resourcing Development.</p>
              <p><a class="btn btn-primary btn-large">Pelajari Lebih Lanjut <i class="icon-circle-arrow-right icon-white"></i> </a></p>
            </div>
      </div>
      </div>
    <?php } ?>
	</section>
  <section class="content-footer">
            <div class="box">
              <div class="row">
              <div class="col-md-4 pull-right">
                    <form action="<?php echo site_url('news'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                                <?php 
                                    if ($q <> '')
                                    {
                                        ?>
                                        <a href="<?php echo site_url('news'); ?>" class="btn btn-default">Reset</a>
                                        <?php
                                    }
                                ?>
                              <button class="btn btn-primary" type="submit">Search</button>
                            </span>
                        </div>
                    </form>
                    </div>
                 <div class="col-md-12">
                   <fieldset>
                      <legend>News Update</legend>
                       <h2><?php echo $title; ?></h2>
                       <div class="row">
                      <?php foreach ($news_update as $news_item): ?>
                          <div class="col-md-5 text-center">
                            <h3><?php echo $news_item['title']; ?></h3>
                            <div class="main">
                                    <?php echo substr($news_item['text'],50) ?>
                            </div>
                            <p><a href="<?php echo site_url('news/'.str_replace(" ","-",$news_item['slug'])); ?>">View article</a></p>
                            </div>
                      <?php endforeach; ?>
                    </div>
                    </fieldset>
                 </div>
                  <div class="col-md-3">
                    <fieldset>
                      <legend>News Later</legend>
                      <?php foreach ($news_later as $news_item): ?>
                            <p><a href="<?php echo site_url('news/'.str_replace(" ","-",$news_item['slug'])); ?>"><?php echo $news_item['title']; ?></a></p>

                    <?php endforeach; ?>
                    </fieldset>
                  </div>
              </div>
            </div>
            <div class="box-footer text-center">
               <?php if($total_rows == null){?>
              <font color="red"> Record Not Found! </font>
              <?php }else{?>
                <?php echo $pagination; }?>
                </div>
              </div>
              
            </div>
         </div>
  </section>
</div>
