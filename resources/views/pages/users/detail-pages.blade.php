    <?php
        $rec_id = $masterRecordId ?? null;
        $page_id = "tab-".random_str(6);
    ?>
    <div class="master-detail-page card">
        <div class="card-header text-bold h5 p-3 mb-3">Users Records</div>
        <div class="p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a data-bs-toggle="tab" href="#ledgers_<?php echo $page_id ?>" class="nav-link active">
                    {{ __('usersLedgers') }}
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="tab" href="#locations_<?php echo $page_id ?>" class="nav-link ">
                {{ __('usersLocations') }}
            </a>
        </li>
    </ul>
</div>
<div class="tab-content">
    <div class="tab-pane fade show active" id="ledgers_<?php echo $page_id ?>" role="tabpanel">
    <div class=" ">
        <?php
            $params = ['user_id' => $rec_id,'show_header' => false]; //new query param
            $query = array_merge(request()->query(), $params);
            $queryParams = http_build_query($query);
            $url = url("ledgers/index/user_id/$rec_id?$queryParams");
        ?>
        <div class="ajax-inline-page" data-url="{{ $url }}" >
            <div class="ajax-page-load-indicator">
                <div class="text-center d-flex justify-content-center load-indicator">
                    <span class="loader mr-3"></span>
                    <span class="fw-bold">{{ __('loading') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade show " id="locations_<?php echo $page_id ?>" role="tabpanel">
<div class=" ">
    <?php
        $params = ['created_by' => $rec_id,'show_header' => false]; //new query param
        $query = array_merge(request()->query(), $params);
        $queryParams = http_build_query($query);
        $url = url("locations/index/created_by/$rec_id?$queryParams");
    ?>
    <div class="ajax-inline-page" data-url="{{ $url }}" >
        <div class="ajax-page-load-indicator">
            <div class="text-center d-flex justify-content-center load-indicator">
                <span class="loader mr-3"></span>
                <span class="fw-bold">{{ __('loading') }}</span>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
