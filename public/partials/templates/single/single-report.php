<?php 
$report_enable  = get_option( 'enable_report_form' );
$report_reasons = get_option( 'list_reason_form');
$reasons = false;
if($report_reasons)
    $reasons        = explode("\n", str_replace("\r", "", $report_reasons));

if($report_enable){ ?>
    <li class="fg1 b-fg0 px04 c-f14 d-f16"
    x-data="{ mdl: false }"
    @keydown.escape="{ mdl = false }">
        <button class="btn f14 py0 px08 bgt text-c link-c-h" type="button"
        @click="mdl = !mdl">
            <i class="fa-flag far b-mr08"></i><span class="dno b-dbk"><?php echo lang_torotube('Report', 'lang_report'); ?></span>
        </button>
        <div class="mdl-bx pof lt0 tp0 w100p h100p dark-bgt-05 aic jcc pd16 zi9"
        :class="{ 'dfx': mdl }"
        x-show="mdl"
        x-cloak>
            <div class="mdl snow-b dno w100p pd24 br04 tai"
            :class="{ 'dbk': mdl }"
            x-show.transition="mdl"
            @click.away="mdl = false">
                <form data-id="<?php echo $id; ?>" id="form-report">
                    <div class="mdl-hd dfx aic jcb">
                        <div class="ttl h123-c"><?php echo lang_torotube('Report', 'lang_report'); ?></div>
                        <button class="btn bgt co01-c" type="button"
                        @click="mdl = !mdl">
                            <i class="fa-times far f20"></i>
                        </button>
                    </div>
                    <?php if($reasons){ foreach ( $reasons as $key => $reason) { ?>
                        <p class="chk mt0">
                            <input type="radio" value="<?php echo $reason; ?>" name="report_reason">
                            <span class="fa-check"><?php echo $reason; ?></span>
                        </p>
                    <?php } } ?>
                    <p class="mt08">
                        <textarea placeholder="<?php echo lang_torotube('Give us more details', 'lang_give_us'); ?>" id="form-desc" cols="30" rows="6"></textarea>
                    </p>
                    <p class="mt16">
                        <button class="btn fwb w100p" type="submit"><?php echo lang_torotube('Send Report', 'lang_send_report'); ?></button>
                    </p>

                    <div id="res-wrong-form"></div>
                </div>
            </form>
        </div>
    </li>
<?php }  ?>