<?php $headerObject = new \stdClass(); ?>
<?php $headerObject->description = $info['subtitle']; ?>
<?php echo widget('Home.Common')->header($headerObject); ?>
    <div class="content col-md-9">
        <?php echo widget('Home.Common')->top(); ?>

        <div class="main-content">
          <div>
            <h2><?php echo $info['name']; ?></h2>
          </div>
          <div class="row blog-post">
            <div class="col-sm-9 main-content">

                <div id="blog-posts">
                    <p class="pull-right small">
                        <a href="#detail-comment"><i class="icon-comments"></i>查看评论</a>
                    </p>
                    <p class="text-sm p_h_info">
                        <span class="span_h_info">副标题：</span><?php echo $info['subtitle']; ?> &nbsp&nbsp&nbsp
                        <span class="span_h_info">作者：</span><?php echo $info['other']; ?> &nbsp&nbsp&nbsp
                        <span class="span_h_info">发布时间：</span><?php echo $info['create_at']; ?>

                    </p>
                    <div class="h-detail-summary"><?php echo $info['subtitle']; ?></div>
                    <div class="main-article-detail">
                        <?php echo $info['content']; ?>
                    </div>
                </div>


            </div>
            <?php echo widget('Home.Common')->right(); ?>
          </div>

        <?php echo widget('Home.Common')->footer(); ?>

        </div>
    </div>
<?php echo widget('Home.Common')->htmlend(); ?>
