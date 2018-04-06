<div class="layout-content">
    <div class="layout-content-body">
        <div class="row gutter-xs">
            <div class="col-md-6 col-lg-3 col-lg-push-0">
                <a href="<?= base_url(). 'Admin/manage_products'?>">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-middle media-left">
                          <span class="bg-primary-inverse circle sq-48">
                            <span class="icon icon-cubes"></span>
                          </span>
                                </div>
                                <div class="media-middle media-body">
                                    <h6 class="media-heading">Total Products</h6>
                                    <h3 class="media-heading">
                                        <span class="fw-l"><?= $counters['products']?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-lg-push-3">
                <a href="<?= base_url().'Admin/get_paid_invoices'?>">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-middle media-left">
                      <span class="bg-primary-inverse circle sq-48">
                        <span class="icon icon-dollar"></span>
                      </span>
                            </div>
                            <div class="media-middle media-body">
                                <h6 class="media-heading">Paid Invoice</h6>
                                <h3 class="media-heading">
                                    <span class="fw-l"><?/*= $counters['paid_invoice'] */?></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-lg-pull-3">
                <a href="<?= base_url().'Admin/manage_customers'?>">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-middle media-left">
                          <span class="bg-primary-inverse circle sq-48">
                            <span class="icon icon-users"></span>
                          </span>
                                </div>
                                <div class="media-middle media-body">
                                    <h6 class="media-heading">Total Customer</h6>
                                    <h3 class="media-heading">
                                        <span class="fw-l"><?= $counters['customers']?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-lg-pull-0">
                <a href="<?= base_url().'Admin/get_unpaid_invoices'?>">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-middle media-left">
                          <span class="bg-primary-inverse circle sq-48">
                            <span class="icon icon-dollar"></span>
                          </span>
                                </div>
                                <div class="media-middle media-body">
                                    <h6 class="media-heading">Unpaid Invoice</h6>
                                    <h3 class="media-heading">
                                        <span class="fw-l"><?/*= $counters['unpaid_invoice']*/?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row gutter-xs">
            <div class="col-md-6 col-lg-3 col-lg-push-0">
                <a href="<?= base_url(). 'Admin/current_month_sales'?>">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-middle media-left">
                          <span class="bg-primary-inverse circle sq-48">
                            <span class="icon icon-dollar"></span>
                          </span>
                                </div>
                                <div class="media-middle media-body">
                                    <h6 class="media-heading">This Month Income</h6>
                                    <h3 class="media-heading">
                                        <span class="fw-l">$<?/*= $counters['income']*/?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-lg-push-3">
                <a href="<?= base_url().'Admin/today_purchase_report'?>">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-middle media-left">
                      <span class="bg-primary-inverse circle sq-48">
                        <span class="icon icon-dollar"></span>
                      </span>
                                </div>
                                <div class="media-middle media-body">
                                    <h6 class="media-heading">Today's Purchase</h6>
                                    <h3 class="media-heading">
                                        <span class="fw-l">$<?/*= $counters['today_purchase'] */?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-lg-pull-3">
                <a href="<?= base_url().'Admin/manage_customers'?>">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-middle media-left">
                          <span class="bg-primary-inverse circle sq-48">
                            <span class="icon icon-users"></span>
                          </span>
                                </div>
                                <div class="media-middle media-body">
                                    <h6 class="media-heading">This Month Expense</h6>
                                    <h3 class="media-heading">
                                        <span class="fw-l">$<?/*= $counters['expense']*/?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-lg-pull-0">
                <a href="<?= base_url().'Admin/today_sales_report'?>">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-middle media-left">
                          <span class="bg-primary-inverse circle sq-48">
                            <span class="icon icon-dollar"></span>
                          </span>
                                </div>
                                <div class="media-middle media-body">
                                    <h6 class="media-heading">Today's Sale</h6>
                                    <h3 class="media-heading">
                                        <span class="fw-l">$<?/*= $counters['today_sale'] */?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row gutter-xs">
            <div class="col-xs-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Weekly Sale</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-chart">
                            <canvas data-chart="bar" data-animation="false"
                                    data-labels='<?/*= $weekly_sale['week_days']; */?>'
                                    data-values='[{"label": "This week", "backgroundColor": "#1c90fb", "borderColor": "#1c90fb",
                                    "data": <?/*= $weekly_sale['values']; */?>}]' data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend", "points"]'
                                    data-scales='{"yAxes": [{"gridLines": {"color": "#f5f5f5"}, "ticks": {"fontColor": "#bcc1c6", "maxTicksLimit": 5}}], "xAxes": [{ "gridLines": {"color": "#f5f5f5"}, "ticks": {"fontColor": "#bcc1c6"}} ]}' height="128"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Weekly Purchase</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-chart">
                            <canvas data-chart="bar" data-animation="false"
                                    data-labels='<?/*= $weekly_purchase['week_days']; */?>'
                                    data-values='[{"label": "This week", "backgroundColor": "#1c90fb", "borderColor": "#1c90fb",
                                    "data": <?/*= $weekly_purchase['values']; */?>}]' data-tooltips='{"mode": "label"}' data-hide='["gridLinesX", "legend", "points"]'
                                    data-scales='{"yAxes": [{"gridLines": {"color": "#f5f5f5"}, "ticks": {"fontColor": "#bcc1c6", "maxTicksLimit": 5}}], "xAxes": [{ "gridLines": {"color": "#f5f5f5"}, "ticks": {"fontColor": "#bcc1c6"}} ]}' height="128"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>