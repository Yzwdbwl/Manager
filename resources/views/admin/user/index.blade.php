<?php echo widget('Admin.Common')->header(); ?>
    <?php echo widget('Admin.Common')->top(); ?>
    <?php echo widget('Admin.Menu')->leftMenu(); ?>
    <div class="content">
        <?php echo widget('Admin.Menu')->contentMenu(); ?>
        <?php echo widget('Admin.Common')->crumbs('User'); ?>
        <div class="main-content">
          <div id="sys-list">
          <div class="row">
              <div class=" col-md-12">
                  <div class="panel panel-default">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>

                            <th>User name</th>
                            <th>User group</th>

                            <th>Last log in</th>
                            <th>To do</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($userList as $key => $value): ?>
                            <tr>
                              <td><?php echo $value['name']; ?></td>
                              <td><?php echo $value['group_name']; ?></td>
                              <td><?php echo date('Y-m-d H', $value['last_login_time']); ?></td>
                              <td>
                                <?php echo widget('Admin.User')->edit($value); ?>
                                <?php echo widget('Admin.User')->acl($value); ?>
                                <?php echo widget('Admin.User')->delete($value); ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      </div>
                  </div>
              </div>
          </div>
          <?php echo $page; ?>
          </div>
          <?php echo widget('Admin.Common')->footer(); ?>
        </div>
    </div>
<?php echo widget('Admin.Common')->htmlend(); ?>
