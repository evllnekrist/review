@extends('layout.main')
@section('title','Satisfaction')
@section('style')
	<style>
		.txt-label{
			font-family: 'Poppins' !important;
			font-size: 1.1rem;
			font-style: italic;
			color: white;
		}
		.txt-label2{
			font-family: 'Poppins' !important;
  			font-weight: 500;
			font-size: 0.9rem;
			color: grey;
		}
		.txt-wrap{
			word-wrap: break-word;
		}
		.bg-strawberry{
			background-color: #e71133 !important;
		}
		.txt-strawberry{
			color: #e71133 !important;
		}
		.btn-strawberry{
			background-color: #e71133;
			color: white;    
			padding: 10px 100px;
    		border-radius: 20px;
		}
		.btn-strawberry:hover{
			/* background-color: #fbd0d7;
			color: #e71133; */
			background-color: #fde16d;
			color: brown;
		}
		@media only screen and (max-width: 1024px) {
			.btn-strawberry-lite{
				width: 100px;
			}
			.btn-strawberry-lite-choosen{
				width: 100px;
			}
			@media only screen and (max-width: 480px) {
				.txt-wrap{
					width: 300px;
					font-size: 0.75rem;
				}
			}
			@media only screen and (min-width: 481px) and (max-width: 768px) {
				.txt-wrap{
					width: 620px;
				}
			}
			@media only screen and (min-width: 769px) and (max-width: 1024px) {
				.txt-wrap{
					width: 820px;
				}
			}
		}
		@media only screen and (min-width: 1025px) {
			.btn-strawberry-lite{
				width: 180px;
			}
			.btn-strawberry-lite-choosen{
				width: 180px;
			}
		}
		.btn-strawberry-lite{/*.btn-strawberry-lite-choosen:hover,.btn-strawberry-lite-choosen:active{*/
			border-width: medium;
			border-color: #e71133;
			color: #e71133;
			padding-top: 12px;
			padding-bottom: 12px;
    		border-radius: 10px;
			font-size: 10px;
		}
		.btn-strawberry-lite-choosen{/*,.btn-strawberry-lite:hover,.btn-strawberry-lite:active{*/
			border-width: medium;
			border-color: #fde7eb;
			/* background-color: #e71133;
			color: white;   */
			/* background-color: #fbd0d7;
			color: #e71133; */
			background-color: #fde16d;
			color: brown;
			padding-top: 12px;
			padding-bottom: 12px;
    		border-radius: 10px;
			font-size: 10px;
		}
	</style>
	<link href="{{ asset('assets/css/star-rating.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/templates/krajee-fa/theme.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/templates/krajee-fas/theme.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/templates/krajee-svg/theme.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/templates/krajee-uni/theme.min.css') }}" rel="stylesheet" />
@endsection
@section('container')
	<!--begin::Card-->
	<div class="card card-custom card-sticky" id="kt_page_sticky_card">
		<div class="card-header bg-strawberry" style="min-height:60px!important">
			<div class="card-title">
				<img src="{{ asset('assets/media/logos/logo_ace_bw.png') }}" width="70px">
			</div>
			<div class="card-toolbar">
				<strong class="txt-label">Hai,&nbsp;{{@$detail['member_name']}}</strong>
			</div>
		</div>
		<div class="card-body">
			<!--begin::Form-->
			<form class="form" id="kt_form">
				<div class="row">
					<div class="col-xl-2"></div>
					<div class="col-xl-8">
						<center>
							<input type="text" name="request_assistance_id_hash" value="{{$request_assistance_id_hash}}" hidden>
							<!-- <input type="text" name="score" value="" hidden> -->
						</center>
						<div class="my-3">
							<div class="row justify-content-center">
								<?php
									function  changeLangIndo($type,$value) {
										if($type == 'day'){
											switch ($value) {
												case 'Sunday'	: return 'Minggu';
												case 'Monday'	: return 'Senin';
												case 'Tuesday'	: return 'Selasa';
												case 'Wednesday': return 'Rabu';
												case 'Thursday'	: return 'Kamis';
												case 'Friday'	: return 'Jumat';
												case 'Saturday'	: return 'Sabtu';
												default: return 'hari tidak valid';
											}
										}else if($type == 'month'){
											switch ($value) {
												case 'January'	: return 'Januari';
												case 'February'	: return 'Februari';
												case 'March'	: return 'Maret';
												case 'April'	: return 'April';
												case 'May'		: return 'Mei';
												case 'June'		: return 'Juni';
												case 'July'		: return 'Juli';
												case 'August'	: return 'Agustus';
												case 'September': return 'September';
												case 'October'	: return 'Oktober';
												case 'November'	: return 'November';
												case 'December'	: return 'Desember';
												default: return 'bulan tidak valid';
											}
										}
									}
									$result = '';
									if(@$detail['request_date']){
										$result .= 'pada hari '.changeLangIndo('day',date('l', strtotime(@$detail['request_date'])));
										$result .= ', '.date('d', strtotime(@$detail['request_date'])).' '.changeLangIndo('month',date('F', strtotime(@$detail['request_date']))).' '.date('Y', strtotime(@$detail['request_date']));
									}
								?>
								<center class="txt-label2 txt-wrap">
									Terima kasih atas kunjungan kamu <br>ke toko {{@$detail['site']->name}} {{$result}}.<br>
									Untuk melayani kamu lebih baik lagi, bantu kami dengan memberikan kesan dan masukan:<br>
								</center>
							</div>
						</div>
						<div class="my-5">
							<div class="row justify-content-center">
								<div id="form_info">
									@if(@$selected)
										<center>
											<span class="text-primary"><h2>Thank you, </h2><h6>You have entered a satisfaction rating</h6></span>
										</center>
									@endif
								</div>
							</div>
							<div class="row justify-content-center">
								<input id="in_score" name="score" type="number" data-size="lg" value="{{@$selected->score}}" class="kv-ltr-theme-fas-alt rating-loading">
								<!-- 
									<img class="emo-col-5{{--@$selected?'-ro':'--'}}" src="{{--asset('assets/media/logos/human-emotion-1'.((@$selected && @$selected->score != 1)?'-bw':'').'.png')--}}" data-value="1" data-src="{{--asset('assets/media/logos/human-emotion-1')--}}">
									<img class="emo-col-5{{--@$selected?'-ro':'--'}}" src="{{--asset('assets/media/logos/human-emotion-2'.((@$selected && @$selected->score != 2)?'-bw':'').'.png')--}}" data-value="2" data-src="{{--asset('assets/media/logos/human-emotion-2')--}}">
									<img class="emo-col-5{{--@$selected?'-ro':'--'}}" src="{{--asset('assets/media/logos/human-emotion-3'.((@$selected && @$selected->score != 3)?'-bw':'').'.png')--}}" data-value="3" data-src="{{--asset('assets/media/logos/human-emotion-3')--}}">
									<img class="emo-col-5{{--@$selected?'-ro':'--'}}" src="{{--asset('assets/media/logos/human-emotion-4'.((@$selected && @$selected->score != 4)?'-bw':'').'.png')--}}" data-value="4" data-src="{{--asset('assets/media/logos/human-emotion-4')--}}">
									<img class="emo-col-5{{--@$selected?'-ro':'--'}}" src="{{--asset('assets/media/logos/human-emotion-5'.((@$selected && @$selected->score != 5)?'-bw':'').'.png')--}}" data-value="5" data-src="{{--asset('assets/media/logos/human-emotion-5')--}}">
							 	-->
							</div>
							<div class="row justify-content-center">
								<span id="in_score_info"></span>
							</div>
						</div>
						<div class="my-3">
							<?php 
								$i_mod = 2; 
								$selected_score_complimentary = array();
								if(@$selected->score_complimentary){
									$selected_score_complimentary = (explode(",",@$selected->score_complimentary));
								}
							?>
							@foreach($list_score_complimentary as $key => $item)
							<?php $i_mod--; ?>
								@if($i_mod == 1)
								<div class="d-flex justify-content-center">
								@endif
									<div class="p-2">
										<input type="checkbox" class="btn-check btn-score_complimentary" name="score_complimentary[]" value='{{@$item->value}}' id="score_complimentary_{{@$item->value}}" autocomplete="off"  {{in_array(@$item->value,$selected_score_complimentary)?'checked':''}} {{!empty($selected_score_complimentary)?'disabled':''}} hidden>
										<label class="btn {{in_array(@$item->value,$selected_score_complimentary)?'btn-strawberry-lite-choosen':'btn-strawberry-lite'}}" for="score_complimentary_{{@$item->value}}" id="score_complimentary_{{@$item->value}}_btn"><b>{{@$item->name}}</b></label>
									</div>
								@if($i_mod == 0)
								<?php $i_mod = 2; ?>
								</div>
								@endif
							@endforeach
						</div>
						<div class="my-2">
							<div class="form-group">
								<textarea name="note" class="form-control" rows="3" placeholder="Ketik komentar disini ..." @if(@$selected) readonly disabled @endif>{{@$selected->note}}</textarea>
							</div>
							<div class="row justify-content-center">
								<span id="in_note_info"></span>
							</div>
							<div class="row justify-content-center">
								@if(@$selected)
									<i style="color:grey"><smallxtra>view only</smallxtra></i>
								@else
									<button type="button" class="btn btn-strawberry font-weight-bolder" id="btn-submit-satisfaction">Submit</button>
								@endif
							</div>
						</div>
					</div>
					<div class="col-xl-2"></div>
				</div>
			</form>
			<!--end::Form-->
		</div>
	</div>
	<!--end::Card-->
@endsection
@section('script')
<script src="{{ asset('assets/js/star-rating.min.js') }}"></script>
<script src="{{ asset('assets/templates/krajee-fa/theme.min.js') }}"></script>
<script src="{{ asset('assets/templates/krajee-fas/theme.min.js') }}"></script>
<script src="{{ asset('assets/templates/krajee-svg/theme.min.js') }}"></script>
<script src="{{ asset('assets/templates/krajee-uni/theme.min.js') }}"></script>
<script>
	$(document).ready(function() {
    	"use strict"

		$("#in_score").rating({
			hoverOnClear: false,
            // theme: 'krajee-svg',
        	theme: 'krajee-fas',
			step: 1,
            stars: 5,
            tabindex: 0,
            mouseEnabled:true,
            clearValue: 0,
            hoverChangeStars:true,
            hoverChangeCaption:true,
            showClear: false,
            showCaption: true,
            zeroAsNull: true,
			displayOnly: '{{@$selected->score}}'?true:false,
            // filledStar:'<span class="krajee-icon krajee-icon-star"></span>',
            // emptyStar:'<span class="krajee-icon krajee-icon-star"></span>',
			starCaptions: {0:'<b>Belum Dinilai</b>', 1:'<b>Very Poor</b>', 2:'<b>Poor</b>', 3:'<b>Ok</b>', 4:'<b>Good</b>', 5: '<b>Very Good</b>'},
			starCaptionClasses: {0: 'text-grey', 1: 'txt-strawberry', 2: 'text-warning', 3: 'text-info', 4: 'text-primary', 5: 'text-success'}
        });

		// $(".emo-col-5").click(function(){
		// 	let el = this;
		// 	$('#in_score_info').html('');
		// 	$('[name="score"]').val($(el).data('value'));
		// 	$(".emo-col-5").each(function(){
		// 		if($(this).data('value') == $(el).data('value')){
		// 			$(this).attr('src',$(this).data('src')+".png");
		// 		}else{
		// 			$(this).attr('src',$(this).data('src')+"-bw.png");
		// 		}
		// 	});
		// });

		$(".btn-score_complimentary").change(function(){
			console.log('uhuy');
			let value = $(this).val();
			if(this.checked) {
				$('#score_complimentary_'+value+'_btn').removeClass('btn-strawberry-lite');
				$('#score_complimentary_'+value+'_btn').addClass('btn-strawberry-lite-choosen');
			}else{
				$('#score_complimentary_'+value+'_btn').addClass('btn-strawberry-lite');
				$('#score_complimentary_'+value+'_btn').removeClass('btn-strawberry-lite-choosen');
			}
		});

		$("#btn-submit-satisfaction").click(function(){
			let request_assistance_id_hash 	= $('[name="request_assistance_id_hash"]').val();
			let score 						= $('[name="score"]').val();
			let score_complimentary			= $("[name='score_complimentary[]']").map(function(){return this.checked?$(this).val():false;}).get().join(',');
			let note 						= $('[name="note"]').val();
			// console.log('rating recap: ');
			// console.log(score);
			// console.log(score_complimentary);
			// console.log(note);
			// return 0;
			if(!score){
				// $('#in_score_info').html('<span class="text-danger">* <b>Required</b>, please select 1 emoticon</span>');
				// $('#in_score_info').html('<span class="text-danger">* <b>Required</b>, please select rating</span>');
				$('#in_score_info').html('<span class="text-danger">* <b>Wajib diisi</b>, silakan pilih rating</span>');
			}else if(!note){
				$('#in_note_info').html('<span class="text-danger">* <b>Wajib diisi</b>, berikan kami sepatah dua patah kata, kesan atau masukan</span>');
			}else{
				$('#in_score_info').html('');
				$.ajax({
					url:base_url+'/satisfaction/submit',
					headers: {
						'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
					},
					type: "POST",
					data: {
						request_assistance_id_hash	: request_assistance_id_hash,
						score						: score,
						score_complimentary			: score_complimentary,
						note						: note
					},
					success: (function (data) {
						if(data.status){
							Swal.fire({
								title: "Thank you",
								html: data.message,
								type: "success",
								confirmButtonClass: 'btn btn-primary',
								buttonsStyling: false,
							});
							$('[name="note"]').attr('readonly','readonly');
							$('[name="note"]').attr('disabled','disabled');
							$(".emo-col-5").addClass('emo-col-5-ro');
							$(".emo-col-5").removeClass('emo-col-5');
							$('#form_info').html('<center><span class="text-primary"><h2>Thank you, </h2><h6>You have entered a satisfaction rating</h6></span></center>');
							location.reload();
						}else{
							Swal.fire({
								title: "Opps.. ",
								html: data.message,
								type: "error",
								confirmButtonClass: 'btn btn-primary',
								buttonsStyling: false,
							});
						}
					}),error:function(xhr,status,error) {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: xhr.responseText,
							type: "error",
							buttonsStyling: false,
							confirmButtonClass: "btn btn-error"
						});
					}
				});
			}
		});
	});
</script>
@endsection
