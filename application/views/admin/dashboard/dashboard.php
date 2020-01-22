<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">

        <!-- Indicates a successful or positive action -->

        <div class="strong">
            <h1>Selamat Datang di Halaman Administrator</h1>
			<strong><?php echo $this->session->userdata('username'); ?> (<?php echo $this->session->userdata('nama_lengkap'); ?>) </strong>
			<br>
			<?php echo pretty_date(date('Y-m-d'), 'l, d F Y',FALSE) ?> 
		</div>
		<br><br><br>
		<div class="col-md-3 col-md-offset-2">
			<div class="wBlock green clearfix"> 
				<div class="dSpace">
					<?php
					$ttl_msk = null;
					foreach ($total_spp as $row) {
						$ttl_msk = $ttl_msk+$row['total_biaya'];
					}
					foreach ($total_bangun as $row) {
						$ttl_msk = $ttl_msk+$row['jmlh_byr'];
					}
					?>
				<h3><b>Jumlah Pemasukan</b></h3>
					<span class="mChartBar" sparkType="bar" sparkBarColor="white"></span>
					<span class="number">Rp. <?php echo $ttl_msk;?></span> 
				</div>
			</div> 	
		</div>

		<div class="col-md-3 col-md-offset-2">
			<div class="wBlock red clearfix"> 
				<div class="dSpace">
					<?php
					$ttl_keluar = null;
					foreach ($total_keluar as $row) {
						$ttl_keluar = $ttl_keluar+$row['biaya'];
					}
					
					?>
				<h3><b>Jumlah Pengeluaran</b></h3>
					<span class="mChartBar" sparkType="bar" sparkBarColor="white"></span>
					<span class="number">Rp. <?php echo $ttl_keluar;?></span> 
				</div>

			</div> 	
		</div>

			
	</div>

		
</div>

<style type="text/css">
 .upper { text-transform: uppercase; }
 .lower { text-transform: lowercase; }
 .cap   { text-transform: capitalize; }
 .small { font-variant:   small-caps; }

 .wBlock{float: left; position: relative; width: 100%; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; margin-bottom: 20px;
                        color: #FFF;                        
                        background: #416C9B;
                        background: -moz-linear-gradient(top, #5B7EA4 0%, #416C9B 100%);
                        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#5B7EA4), color-stop(100%,#416C9B));
                        background: -webkit-linear-gradient(top, #5B7EA4 0%,#416C9B 100%);
                        background: -o-linear-gradient(top, #5B7EA4 0%,#416C9B 100%);
                        background: -ms-linear-gradient(top, #5B7EA4 0%,#416C9B 100%);
                        background: linear-gradient(top, #5B7EA4 0%,#416C9B 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5B7EA4', endColorstr='#416C9B',GradientType=0 );
                        -moz-box-shadow: 0 1px 1px #222, 0px 1px 0 #7797ba inset;
                        -webkit-box-shadow: 0 1px 1px #222, 0px 1px 0 #7797ba inset;
                        box-shadow: 0 1px 1px #222, 0px 1px 0 #7797ba inset;                           
                }
.wBlock .wSpace{background-color: #FFF; padding: 0px 5px; margin: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px;
                                    -moz-box-shadow: 0px 0px 2px #999 inset; -webkit-box-shadow: 0px 0px 2px #999 inset; box-shadow: 0px 0px 2px #999 inset;}
                    .wBlock .dSpace{ margin: 0px 5px 5px; margin-top: 5px; background-color: #365B85; padding: 3px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; float: left;
                                    -moz-box-shadow: 0px 0px 2px #222 inset; -webkit-box-shadow: 0px 0px 2px #222 inset; box-shadow: 0px 0px 2px #222 inset; width: 96%; min-width: 82px; min-height: 72px;}
                                        
                    .wBlock .rSpace{width: 47%; float: right; margin: 5px 0px;}
                    
                    .menu .wBlock{margin-bottom: 0px;}
                    
                    .wBlock.auto{ width: auto; margin-right: 20px;}
                        .wBlock.auto .dSpace,
                        .wBlock.auto .rSpace{width: auto;}                                        
                    
                        .wBlock .dSpace h3,
                        .wBlock .rSpace h3{
	padding: 0px;
	font-size: 12px;
	text-align: center;
	color: #c7e3fc;
	font-weight: normal;
	line-height: 14px;
	-moz-text-shadow: 0 1px 0 #333;
	-webkit-text-shadow: 0 1px 0 #333;
	text-shadow: 0 1px 0 #333;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 2px;
	margin-left: 0px;
}
                        .wBlock .dSpace span,
                        .wBlock .rSpace span{display: block; text-align: center; color: #FFF; font-size: 12px; line-height: 16px;
                                            -moz-text-shadow: 0 1px 0 #333; -webkit-text-shadow: 0 1px 0 #333; text-shadow: 0 1px 0 #333;}
                            .wBlock .dSpace span.number{
	font-size: 30px;
	color: #FFF;
	font-weight: bold;
	line-height: 32px;
	margin-top: 8px;
}
                            .wBlock .dSpace span b,
                            .wBlock .rSpace span b{font-weight: normal; color: #c7e3fc;}                        
                        .wBlock .rSpace h3{text-align: left;}
                        .wBlock .rSpace span{text-align: left; margin-top: 2px;}
                        
                        .wBlock.gray .dSpace{background-color: #555;}
                            .wBlock.gray .dSpace h3{color: #F5F5F5;}
                            .wBlock.gray .rSpace span,
                            .wBlock.gray .rSpace span b{color: #000; -moz-text-shadow: 0 1px 0 #FFF; -webkit-text-shadow: 0 1px 0 #FFF; text-shadow: 0 1px 0 #FFF;}
                            .wBlock.gray .rSpace span b{color: #555;}
                        
                        .wBlock.green .dSpace{background-color: #677C12;}
                        .wBlock.yellow .dSpace{background-color: #9B7503;}
                        .wBlock.red .dSpace{background-color: #7F1C0F;}
                        .wBlock.blue .dSpace{background-color: #4A82BA;}
                        
                        .wBlock.green .dSpace h3,
                        .wBlock.green .rSpace span b{color: #F9FFD6;}
                        
                        .wBlock.yellow .dSpace h3,
                        .wBlock.yellow .rSpace span b{color: #FFFCD6;}
                        
                        .wBlock.red .dSpace h3,
                        .wBlock.red .rSpace span b{color: #FFE3E2;}
                        
                        .wBlock.blue .dSpace h3,                        
                        .wBlock.blue .rSpace span b{color: #E2F9FF;}
                        
                        .wBlock.yellow .rSpace span,
                        .wBlock.green .rSpace span,
                        .wBlock.red .rSpace span,
                        .wBlock.blue .rSpace span{color: #FFF;}                  
.wBlock.red{
                border: 1px solid #AF2D1C;
                background: #CB2C1A;
                background: -moz-linear-gradient(top, #D96D3A 0%, #CB2C1A 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#D96D3A), color-stop(100%,#CB2C1A));
                background: -webkit-linear-gradient(top, #D96D3A 0%,#CB2C1A 100%);
                background: -o-linear-gradient(top, #D96D3A 0%,#CB2C1A 100%);
                background: -ms-linear-gradient(top, #D96D3A 0%,#CB2C1A 100%);
                background: linear-gradient(top, #D96D3A 0%,#CB2C1A 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#D96D3A', endColorstr='#CB2C1A',GradientType=0 );
                -moz-box-shadow: 0 1px 1px #AF2D1C, 0px 1px 0 #FC9E76 inset;
                -webkit-box-shadow: 0 1px 1px #AF2D1C, 0px 1px 0 #FC9E76 inset;
                box-shadow: 0 1px 1px #AF2D1C, 0px 1px 0 #FC9E76 inset;
            } 
.widgetButtons .green a, .wBlock.green{
                border: 1px solid #677C13;
                background: #829E18;
                background: -moz-linear-gradient(top, #ADC800 0%, #829E18 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ADC800), color-stop(100%,#829E18));
                background: -webkit-linear-gradient(top, #ADC800 0%,#829E18 100%);
                background: -o-linear-gradient(top, #ADC800 0%,#829E18 100%);
                background: -ms-linear-gradient(top, #ADC800 0%,#829E18 100%);
                background: linear-gradient(top, #ADC800 0%,#829E18 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ADC800', endColorstr='#829E18',GradientType=0 );
                -moz-box-shadow: 0 1px 1px #677C13, 0px 1px 0 #DEF92F inset;
                -webkit-box-shadow: 0 1px 1px #677C13, 0px 1px 0 #DEF92F inset;
                box-shadow: 0 1px 1px #677C13, 0px 1px 0 #DEF92F inset;
            }              


</style>