<div class="container-fluid" id="content">
    <div class="card text-center">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#home" data-toggle="tab">Rule Laundry</a>
          </li>
          <li class="nav-item hide">
            <a class="nav-link" href="#rule" data-toggle="tab">Rule Laundry</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="text-left">
                  <a href="#" class="btn btn-primary disabled" style="margin-bottom: 15px; text-align: left">Tambah Rule</a>
                </div>
                <ul class="list-group list-group-horizontal-lg" id="rules">
                    <?php foreach($data['rules'] as $rule) : ?>
                        <li class="list-group-item" id="list-rule" data-id="<?= $rule['id'] ?>">
                          <h5 class="card-title"><?= $rule['name'] ?></h5>
                          <p class="card-text text-left"><?= $rule['description'] ?></p>
                      </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="tab-pane fade show" id="rule" role="tabpanel" aria-labelledby="home-tab">
                ok
            </div>
          </div>
      </div>
    </div>
</div>