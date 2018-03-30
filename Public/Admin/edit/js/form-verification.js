/**
 * 表单验证
 */
var FORM_VER = new verification();
var nowOperateElement = null;
function verification(){
	this.init=function(tr){
		//var re=/[+-/*/]eee/;
		//alert(re.test('/eee'));
		//说明是在明细列表中的初始化
		var expresses=[];
		var inputs=$('input[name]');
		if( $('#detail_table').length > 0){
			var firstTr=$('#detail_table tbody tr:first');
			$.each(firstTr.find('input'),function(i,e){
				e=$(e);
				if(!!e.attr('express'))
					expresses.push({id:e.attr('id'),express:e.attr('express')});
			});
		}else{
			$.each(inputs,function(i,e){
				e=$(e);
				if(!!e.attr('express'))
					expresses.push({id:e.attr('id'),express:e.attr('express')});
			});
		}
		var selects=$('select');
		//默认是初始化所有input标签，但添加带有明细实体时候，只初始化当前行的input标签，故添加tr来标识~
		if(!!tr){
			inputs=$(tr).find('td').find('input');
			selects=$(tr).find('td').find('select');
			//如果检测长度为0则直接对对象进行初始化
			if(inputs.length==0){
				inputs=tr;
			}
		}
		var entity=$('#GENERIC_ENTITY_NAME').val() || $('#entityName').val();
		var action1=$('#action').val();
		//一，针对form表单的input标签初始化
		inputs.each(function(){
			var e=$(this);

			//console.log(e);
			var eid=e.attr('id');
			//console.log(eid);
			if(e.attr("name")!=null &&e.attr("name").indexOf("owningUser")>=0 && $("#owningUserChange").val()==="true"){
				e.attr(action1,"true");
			}
			//不可更新||不可新建，设为只读
			//console.log(e.attr(action1));
			if(e.attr(action1)=='false'){//action1 = "canCreate"
				$(this).attr("disabled","disabled");
				$(this).val($(this).attr('text')?$(this).attr('text'):$(this).val());
				return true;
			}
			var exps=[];
			var eClass = ""+e.attr('class');

			//动态计算
			for(var i=0;i < expresses.length;i++){
				var exp=expresses[i].express;
				//var id=expresses[i].id;
				eval('var re=/[+-/*/(]'+eid+'/;var re2=/'+eid+'[)+-/*/]/');
				if(re.test(exp)||re2.test(exp)){
					exps.push(expresses[i]);
				}
			}
//			alert(eid+" "+exps.length)
			if(exps.length>0){
				e.on('keyup change',function(){
					FORM_VER.compute2(e,exps);
				});
			}

			//##	城市、地区，添加选择城市	##
			if(eid=='Account.city'){
//				var a_=$.parseHTML('<a style="position:absolute;top:7px;"><i class="glyphicon glyphicon-search"></i></a>');
				var a_=$.parseHTML('<a style="position:absolute;top:5px;"><i class="fa fa-w fa-search"></i></a>');
				a_=$(a_);
				a_.css('right',parseInt(e.parent().css('width'))-parseInt(e.css('width'))-5);
				a_.bind('click',function(){
					selectCity=WXC.dialog({noMask:true, title:'选择地区', url: '/frontend/common/select_city.html?id='+e.attr('id'), width:550, height:300, footer:false});
				});
				e.parent().append(a_);
			}
			//##    定位字段         ##
			if(!!e.attr('data-location')){
				var a_=$.parseHTML('<a id="location" style="position:absolute;top:7px;right:0px;cursor:pointer;"><i class="glyphicon glyphicon-map-marker"></i></a>');
				a_=$(a_);
				a_.bind('click',function(){ FORM_VER.openLocationMap(e); });
				//e.on('input', function(){ $(this).attr('data-lnglat',''); });//改变地址时候去掉其在地图标记的经纬度
				if(!e.attr('readonly')){
					if (e.parent().find('#location').length > 0)
						return true;

					e.parent().append(a_);
					var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
						{"input" : e.attr("id")
							,"location" : '上海'
						});
					ac.addEventListener("onconfirm", function(a){ //根据回填值来查找经纬度
						var localSearch = new BMap.LocalSearch("上海");
						var _value = e.val();
						localSearch.setSearchCompleteCallback(function (searchResult) {
							var poi = searchResult.getPoi(0);
							e.attr("data-lnglat", poi.point.lng + "," + poi.point.lat);
						});
						localSearch.search(e.val());
					});
					//编辑时候赋值
					if(!!e.val() && $.trim(e.val())!=''){
						ac.setInputValue(e.val());
					}
				}else if(!!e.attr('canCreate')){
					$.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function(_result) {
						if (remote_ip_info.ret == '1') {
							var city = remote_ip_info.province==remote_ip_info.city? remote_ip_info.province :(remote_ip_info.province+remote_ip_info.city);
							e.val(remote_ip_info.country+city+remote_ip_info.district);
						} else {}
					});
				}
			}
			else if(!!e.attr('precision')){
				e.on('keyup',function(){
					var p=$(this).attr('precision');
					var keyCode= arguments.callee.caller.arguments[0].keyCode;
					if(keyCode != 37 && keyCode != 39 && (keyCode<48 || keyCode>57)){
						console.log(keyCode);
						if(p==='0')
							this.value = this.value.replace(/[^\d-]/g,"");
						else{
							var rep = /^(\-)*(\d+)\.(\d).*$/;
							switch (p) {
								case '2':
									rep = /^(\-)*(\d+)\.(\d\d).*$/;
									break;
								case '3':
									rep = /^(\-)*(\d+)\.(\d\d\d).*$/;
									break;
								case '4':
									rep = /^(\-)*(\d+)\.(\d\d\d\d).*$/;
									break;
								default:
									break;
							}
							if(this.value.indexOf(".") == 0){
								this.value = this.value.replace(/[^\d-]/g,"");
							}
							while (this.value.indexOf(".") != this.value.lastIndexOf('.')) {
								this.value = this.value.replace(".","");
							}
							this.value = this.value.replace(/[^\d-\.]/g,"").replace(rep,'$1$2.$3');;
						}
					}
				});
			}
			//##	标签字段		##
			else if('#Account.tags#tags#Contact.tags'.indexOf('#'+eid)>-1){
				//e.select2({
				//		ajax:{
				//			url:'/tag/getTags',
				//			dataType: 'json',
				//			type:'POST',
				//			data:function(params){
				//				return {q:params,entityName:entity};
				//			},
				//			cache:true,
				//			results:function(r,p){
				//				return {results:r.results};
				//			}
				//		},
				//		//创建新的tag
				//		createSearchChoice: function(term, data) {
				//			if ($(data).filter( function() { return this.text.localeCompare(term)===0;}).length===0) {
				//				return {id:term, text:term,new_:true};
				//			}
				//		},
				//		//formatResult:function(item){
				//		//	return '<a title="删除标签" onclick="javascript:alert(\'eee\')"><i class="fa fa-fw fa-trash-o" ></i></a>'+item.text;
				//		//},
				//		multiple: true,
				//		placeholder: "选择标签，不存在将新建",
				//		closeOnSelect:false,
				//		formatNoMatches:'没找到，自动新建!',
				//		tags:true
				//	})
				//	.on('select2-selecting',function(e){
				//		var text=e.choice.text;
				//		if(!!e.choice.new_){
				//			$.post('/tag/createTag',{entityName:entity,tagName:text},function(msg){
				//				if(msg.entityId)
				//					WXC.showMsg('添加标签成功!',9,1);
				//				else{
				//					WXC.showMsg(msg.error,8,1);
				//				}
				//			});
				//		}
				//	})
				//	.on("select2-loaded", function(e) {
				//		//alert("loaded (data property omitted for brevitiy)");
				//	});
				//编辑时候赋值
				if(!!e.val() && $.trim(e.val())!=''){
					var data=[];
					$.each(e.val().split(','),function(i,t){data.push({id:t,text:t});});
					//e.select2("data",data, true);
				}
			}
			//##引用字段/多选引用字段，初始化tokeninput##
			else if(((e.attr('reference') || e.attr('referencelist')) &&e.attr(action1)=='true'&&e.attr('readonly')!='readonly'&&!!e.attr('to'))
					|| (e.attr("name")!=null &&e.attr("name").indexOf("owningUser")>=0 && $("#owningUserChange").val()==="true"))
			{
				e.parent().find('ul').remove();//移除已经存在的ul
				var name=e.attr('name');
				var value=e.attr('value');
				if(e.attr('entity'))
					entity=e.attr('entity');
				if(name.indexOf('.')>-1){
					entity=name.split('.')[0];
					name=name.split('.')[1];
				}

				var $lookup = $('<a href="javascript:;" class="lookup"><i class="fa fa-w fa-search"></i></a>');
//				$lookup.css({position:'absolute', top:'6px', right: '20px', opacity: '0.50'});
				$lookup.css({position:'absolute', top:'6px', right: '25px', opacity: '1.0'});
				//明细中的引用字段，td要特殊处理
				if(e.parent().is('td')){
					e.parent().css({position:'relative',paddingRight:'15px'});
					$lookup.css({top:'15px'});
				}
				$lookup.hover(function(){
					$(this).css('opacity', 1.0);
				}, function() {
//					$(this).css('opacity', 0.5);
					$(this).css('opacity', 1.0);
				});
				var lookupCong = {
					type: 2,
					shadeClose: true,
					title: false,
					maxmin: true,
					closeBtn: [0, true],
					shade: [0.5, '#fff'],
					border: [1,1,'#CCC'],
					offset: ['20px',''],
					area: ['450px', '400px']
				};
				$lookup.attr('data-src', '/genericEntity/lookup?entity=' + entity
										 + '&field='+ name + "&tokenValue=id");
				// 引用明细时候的名字主实体
				var toMain = e.attr("toMain");
				if (!!toMain) {
					var cascade_field = "c" + toMain.substring(1, toMain.length) + "Id";
					var toMainValue = $("input[to='" + toMain + "']").val();
					if (!!toMainValue) {
						$lookup.attr('data-src', '/genericEntity/lookup?entity=' + entity
												 + '&field='+ name + "&tokenValue=id&cascade=" + cascade_field + "$$" + toMainValue);
					}
				}
				//多级级联字段（分类、行业、地区、自定义等）特殊处理
				if (e.attr('to') === 'Subject') {
					$lookup.attr('data-src', '/subject/subjectSelect?entity=' + entity + '&field=' + name);
					lookupCong.area = ['620px', '300px'];
				} else if (e.attr('to') === 'Area') {
					$lookup.attr('data-src', '/area/areaSelect?entity=' + entity + '&field=' + name);
					lookupCong.area = ['620px', '300px'];
				} else if (e.attr('to') === 'Product') { //产品特殊处理
					lookupCong.maxmin = false;
					$lookup.attr('data-src', '/product/lookup?entity=' + entity + '&field=' + name + '&isDetail=' + e.parent().is('td'));
					lookupCong.area =  ['620px', '400px'];
				}
				$lookup.on('click', function(){
					nowOperateElement = e;
					lookupCong.iframe = {src: $(this).attr('data-src')};
					//获取搜索路径
					var dpmturl =$(this ).parent().attr('url');
					var source =$(this ).parent().attr('source');
					if(source=='source'){
						layer.open({
							type: 2,
							title: '区域搜索',
							shadeClose: true,
							shade: 0.8,
							area: ['380px', '30%'],
							content: [dpmturl,'no'] //iframe的url
						});
					}else {
						layer.open({
							type: 2,
							title: '搜索页',
							shadeClose: true,
							shade: 0.8,
							area: ['380px', '90%'],
							content: [dpmturl] //iframe的url
						});
					}
				});
				e.parent().append($lookup);

				var tokenLimit = 1;	//选择数量限制,referencelist为多个
				if(e.attr('referencelist')) {
					tokenLimit = 200;
				}
				var opt=new Object;
				opt.hintText='请输入...';
				opt.searchingText= "查找中...";
				opt.tokenLimit=tokenLimit;
				opt.minChars= 0;
				opt.placeholder= e.attr("placeholder") || "请输入";
				opt.theme = 'facebook';
				opt.preventDuplicates = true;	//拒绝重复
				if(e.attr('to')&&e.attr('to')==='xAccount'||e.attr('to')==='Contact'){
					opt.noResultsText="无匹配数据，系统将自动新建";
					opt.allowFreeTagging=true;//允许填写不存在数据(后台新建)
					opt.allowTabOut=true;//允许填写不存在数据(后台新建)
				}else{
					opt.noResultsText="无匹配数据";
				}
				//编辑也要级联，但不映射！
				opt.onAdd = function(item){
					var entity_name = $('#GENERIC_ENTITY_NAME').val() || $('#entityName').val() ;
					if(e.attr('entity')) entity_name=e.attr('entity');
					if(name.indexOf('.')>-1){
						entity_name = name.split('.')[0];
						name=name.split('.')[1];
					}
					FORM_VER.cascade(item.id,entity_name,name,e);
					if (e.attr('canCreate') == 'true') {
						FORM_VER.backFillField(item.id, entity_name, e);
					}
				};
				opt.onDelete=function(item){
					try{
						var entity_name = $('#GENERIC_ENTITY_NAME').val() || $('#entityName').val() ;
						if(e.attr('entity'))
							entity_name=e.attr('entity');
						if(name.indexOf('.')>-1){
							entity_name = name.split('.')[0];
							name=name.split('.')[1];
						}
						return false;
						$.post('/customizedSystemCtrl/cascade?id='+item.id+'&entity='+entity_name+'&name='+name,function(msg){
							if (!msg || !msg.cascade)
								return;
							$.each(msg.cascade,function(i,t){
								try{
									if(t.main){
										var associateField=$('#'+t.associateField).length == 0 ? $('#'+entity_name+'\\.'+t.associateField) : $('#'+t.associateField);
										if(e.parent().is('td')){
											associateField=e.parent().parent().find('#'+t.associateField);
										}
										var url=associateField.data('settings').url;
										var index=url.indexOf('&cascade');
										//清除
										if(index>-1){
											associateField.data('settings').url=url.substring(0,index);
											associateField.tokenInput('clear');
											var lookup = associateField.parent().find('a.lookup');
											var data_src = lookup.attr('data-src');
											//动态改变放大镜的查询链接
											lookup.attr('data-src', data_src.substring(0,data_src.indexOf('&cascade')));
										}
									}
								}catch(e){}
							});
						});
					}catch(e){}
				};
				e.tokenInput('/customizedSystemCtrl/queryRefEntityData?entity='+entity+'&field='+name,opt);
				if(value!=''&&typeof(value)!='undefined'){
					if(e.attr('reference')) {
						e.tokenInput("add",{id:value,name:e.attr('text')});
					} else {
						var opts = e.next('div.opt-warp').find("li");
						opts.each(function(i, opt) {
							var opt = $(opt);
							e.tokenInput("add",{id:opt.attr('value'),name:opt.text()});
						});
					}
				}
				//先初始化，赋值，然后，在给tokeninput添加onAdd和onDelele方法，防止赋值时候触发添加事件，
				opt.onAdd = function(item){
					var entity_name = $('#GENERIC_ENTITY_NAME').val() || $('#entityName').val() ;
					if(e.attr('entity')) entity_name=e.attr('entity');
					if(name.indexOf('.')>-1){
						entity_name = name.split('.')[0];
						name=name.split('.')[1];
					}
					//e.parent().find('.token-input-token p').html('');
					//字段映射回填
					FORM_VER.backFillField(item.id,entity_name,e);
					//级联操作
					FORM_VER.cascade(item.id,entity_name,name,e);
				};
				e.tokenInput('setOptions', opt);
				e.attr('value',value);//e.tokenInput会去除value值，需要重新赋值
				//if(value!=''&&typeof(value)!='undefined'){e.tokenInput("add",{id:value,name:e.attr('text')});}
				e.parent().find('ul').css('width','100%');
			}
			else if(e.attr('multi')){
				//e.select2({
				//	ajax:{
				//		url:'/layoutController/findOptions',
				//		dataType: 'json',
				//		type:'POST',
				//		data:function(params){
				//			var field=eid;
				//			if(eid.indexOf('.')>-1){
				//				entity=eid.split('.')[0];
				//				field=eid.split('.')[1];
				//			}
				//			return {q:params,entity:e.attr('entity') || entity,field:field};
				//		},
				//		cache:true,
				//		results:function(r,p){
				//			return {results:r.results};
				//		}
				//	},
				//	//创建新的tag
				//	createSearchChoice: function(term, data) {
				//		if ($(data).filter( function() { return this.text.localeCompare(term)===0;}).length===0) {
				//			return {id:term, text:term,new_:true};
				//		}
				//	},
				//	multiple: true,
				//	placeholder: "选择项目",
				//	closeOnSelect:false,
				//	tags:true,
				//});
				//编辑时候赋值
				if(!!e.val()&&$.trim(e.val())!=''){
					var data=[];
					$.each(e.val().split(','),function(i,t){data.push({id:t,text:t});});
					//e.select2("data",data, true);
				}
			}
		});
		/**二，赋值(一开始是在初始化时候赋值，但tokeninput添加的时候，如果设置级联关系，那赋值的时候下级还没有初始化，所以先全部初始化再赋值)*/
		var dateTimes = $('.form_datetime['+action1+'="true"]');
		if (!!tr) {
			dateTimes = $(tr).find('.form_datetime[' + action1 + '="true"]');
		}
		dateTimes.each(function() {
			if($(this).attr('readonly')=='readonly')
				return true;
			//创建时候默认值
			var value=$(this).attr('data-value');
			if(action1==='canCreate'&&!!value)
			//$(this).val(value==='$NOW$'?FORM_VER.getCurrentDate('time'):value);
				$(this).val(FORM_VER.getCurrentDate_New("datetime",value));
			//优先使用新版时间插件
			try {
				//新的插件
				$(this).datetimepickerZ({
					lang:'ch',
					format:"Y-m-d H:i:s",      //格式化日期
					timepicker:true    //关闭时间选项
				});
			} catch (e) {
				$(this).datetimepicker({
					language:'zh-CN',
					format:'yyyy-mm-dd hh:ii:ss',
					weekStart:2,
					todayBtn:1,
					autoclose:1,
					todayHighlight:1,
					startView:2,
					forceParse:0
				});
			}
		});
		var dates = $('.form_date[' + action1 + '="true"]');
		if (!!tr) {
			dates = $(tr).find('.form_date[' + action1 + '="true"]');
		}
		dates.each(function() {
			if($(this).attr('readonly')=='readonly')
				return true;
			var value=$(this).attr('data-value');
			if(action1==='canCreate'&&!!value)
			//$(this).val(value==='$NOW$'?FORM_VER.getCurrentDate('date'):value);
				$(this).val(FORM_VER.getCurrentDate_New("date",value));
			try {
				$(this).datetimepickerZ({
					lang:'ch',
					format:"Y-m-d",      //格式化日期
					timepicker:false    //关闭时间选项
				});
			} catch (e) {
				$(this).datetimepicker({
					language : 'zh-CN',
					format : 'yyyy-mm-dd',
					weekStart : 1,
					todayBtn : 1,
					autoclose : 1,
					todayHighlight : 1,
					startView : 2,
					forceParse : 0,
					minView: 2
				});
				$(this).datetimepicker('placeDate');	//日期 特殊处理
			}
		});

		//cheer change for year, yearmonth
		var years = $('.form_year[' + action1 + '="true"]');
		if (!!tr) {
			years = $(tr).find('.form_year[' + action1 + '="true"]');
		}
		years.each(function() {
			if($(this).attr('readonly')=='readonly')
				return true;
			var value=$(this).attr('data-value');
			if(action1==='canCreate'&&!!value)
			//$(this).val(value==='$NOW$'?FORM_VER.getCurrentDate('year'):value);
				$(this).val(FORM_VER.getCurrentDate_New("year",value));
			$(this).datetimepicker({
				language : 'zh-CN',
				format : 'yyyy',
				weekStart : 1,
				todayBtn : 1,
				autoclose : 1,
				todayHighlight : 1,
				startView : 4,
				forceParse : 0,
				minView: 4
			});
			//$(this).datetimepicker('placeDate');	//日期 特殊处理

		});

		//cheer change for year, yearmonth
		var yms = $('.form_ym[' + action1 + '="true"]');
		if (!!tr) {
			yms = $(tr).find('.form_ym[' + action1 + '="true"]');
		}

		yms.each(function() {
			if($(this).attr('readonly')=='readonly')
				return true;
			var value=$(this).attr('data-value');
			if(action1==='canCreate'&&!!value)
				$(this).val(FORM_VER.getCurrentDate_New("yearmonth",value));

			$(this).datetimepicker({
				language : 'zh-CN',
				format : 'yyyy-mm',
				weekStart : 1,
				todayBtn : 0,
				autoclose : 1,
				todayHighlight : 1,
				startView : 3,
				forceParse : 0,
				minView: 3
			});
			//$(this).datetimepicker('placeDate');	//日期 特殊处理

		});

		selects.each(function(i,e){
			//$(e).select2({placeholder: $(e).attr("placeholder") || "--请选择--",allowClear: true});
		});
		//初始化图片字段
		FORM_VER.initPictureField();
		//初始化附件字段
		FORM_VER.initAttachmentField();
	},
		//初始化图片字段的上传显示
		this.initPictureField = function(){
			$.each($('div.picUploadBtn'), function( index ){
				var $uploadBtn = $(this);
				var input_ = $uploadBtn.attr('id').split('-')[0];
				input_ = $uploadBtn.parent().parent().find('#'+input_.replace('.','\\.'));
				var photoAry = !!input_.val() ? input_.val().split('|') : [];
				$uploadBtn.parent().find('div[id^="EXIST"]').on('mouseover', function(){
					$(this).find('.deletePic').show();
				}).on('mouseout', function(){
					$(this).find('.deletePic').hide();
				});
				$(this).parent().find('.deletePic').on('click', function(){
					var parent = $(this).parent();
					var img = parent.find('img');
					photoAry.splice($.inArray(img.attr('data-saveUrl'),photoAry),1);
					input_.val(photoAry.join('|'));
					parent.remove();
				});
				$(this).on('click', function(){
					isImg = 1;
				});
				var pictureSize = $uploadBtn.attr('pictureSize');
				var width = 37;
				var height = 37;
				if (!!pictureSize && pictureSize == 'big'){
					width = 200;
					height = 200;
				}else if (!!pictureSize && pictureSize == 'middle'){
					width = 100;
					height = 100;
				}else{
					width = 37;
					height = 37;
				}
				var uploadState = 'pending';
				var uploader = WebUploader.create({
					auto: true,
					swf: '/js/webuploader/Uploader.swf',
					pick: $uploadBtn,
					resize: true,
					accept: {
						title: 'Images',
						extensions: 'gif,jpg,jpeg,bmp,png',
						mimeTypes: 'image/*'
					}
				});

				uploader.on('all', function( type ) {
					if ( type === 'startUpload' ) {
						uploadState = 'uploading';
					} else if ( type === 'stopUpload' ) {
						uploadState = 'paused';
					} else if ( type === 'uploadFinished' ) {
						uploadState = 'done';
					}
				});

				uploader.on('fileQueued', function( file ) {
					var $li = $('<div id="' + file.id + '" class="file-item thumbnail"><img><span class="uploadInfo"><i class="fa fa-spinner fa-spin f16"></i></span></div>'), $img = $li.find('img');
					$li.on('mouseover', function(){
						$(this).find('.deletePic').show();
					}).on('mouseout', function(){
						$(this).find('.deletePic').hide();
					});
					uploader.makeThumb( file, function( error, src ) {
						if ( error ) {
							$img.replaceWith('<span>不能预览</span>');
							return;
						}

						$img.attr( 'src', src );
					}, width, height );
					$uploadBtn.before( $li );
				});

				uploader.on( 'uploadProgress', function( file, percentage ) {});
				/* 单个文件上传成功后触发 */
				uploader.on("uploadSuccess", function(file, response) {
					$( '#'+file.id ).find('.uploadInfo').remove();
					$deletePic = $('<div class="deletePic"><i class="glyphicon glyphicon-remove"></i></div>');
					$deletePic.on('click', function(){
						uploader.removeFile( file , true );
						$( '#'+file.id ).remove();
						photoAry.splice($.inArray(file.urlForSave,photoAry),1);
						input_.val(photoAry.join('|'));
					});
					$('#'+file.id).append($deletePic);
					photoAry.push(file.urlForSave);
					input_.val(photoAry.join('|'));
				});

				/* 文件上传失败后显示出错信息 */
				uploader.on( 'uploadError', function( file ) {
					alert('上传失败');
				});
			});
		},
		//初始化附件字段的上传显示
		this.initAttachmentField = function(){
			$.each($('div.attachmentUploadBtn'), function( index ){
				var $uploadBtn = $(this);
				var fieldName = $uploadBtn.attr('id').split('-')[0];
				var input_ = $uploadBtn.parent().parent().find('#'+fieldName.replace('.','\\.'));
				//var entityId = WXC.urlp('id') || WXC.urlp('contactId') || WXC.urlp('accountId');
				var photoAry = !!input_.val() ? input_.val().split('|||') : [];
				$uploadBtn.parent().find('div[id^="EXIST"]').on('mouseover', function(){
					$(this).find('.deleteAttachment').show();
				}).on('mouseout', function(){
					$(this).find('.deleteAttachment').hide();
				});
				$(this).parent().find('.deleteAttachment').on('click', function(){
					var parent = $(this).parent();
					photoAry.splice($.inArray(parent.attr('data-saveUrl'),photoAry),1);
					input_.val(photoAry.join('|||'));
					parent.remove();
				});
				var attachmentSizeLimit = $uploadBtn.attr('attachmentSizeLimit');
				var limitSize = (!!attachmentSizeLimit && attachmentSizeLimit.toLowerCase() != 'null' &&
								 attachmentSizeLimit > '0') ? parseInt(attachmentSizeLimit) * 1024 * 1024 : undefined;

				$(this).on('click', function(){
					isImg = 0;
				});
				var uploadState = 'pending';
				var uploader;
				uploader = WebUploader.create({
					auto: true,
					swf: '/js/webuploader/Uploader.swf',
					pick: $uploadBtn,
					resize: true,
					fileSizeLimit: limitSize
				});
				var queueSize = 0;
				uploader.on('beforeFileQueued', function( file ) {
					if (limitSize){
						var fileSize = file.size;
						if (fileSize > (limitSize - queueSize))
							WXC.showMsg('文件超过附件上传最大限制!',9,1);
					}

				});
				uploader.on('all', function( type ) {
					if ( type === 'startUpload' ) {
						uploadState = 'uploading';
					} else if ( type === 'stopUpload' ) {
						uploadState = 'paused';
					} else if ( type === 'uploadFinished' ) {
						uploadState = 'done';
					}
				});

				uploader.on('fileQueued', function( file ) {
					var d = new Date().format("yyyy-MM-dd HH:mm:ss");
					var $li = $('<div id="' + file.id + '"  class="file-item attachmentField thumbnail"><div class="leftIco"><i class="fa fa-w fa-file-o"></i></div>'
								+'<div class="rightName"><span class="spanFieldName">'+file.name+'</span><span class="spanUploadTime">'+d+
								'</span><span class="uploadInfo"><i class="fa fa-spinner fa-spin f16"></i></span></div>');
					$li.on('mouseover', function(){
						$(this).find('.deleteAttachment').show();
					});

					$li.on('mouseout', function(){
						$(this).find('.deleteAttachment').hide();
					});
					$uploadBtn.before( $li );
					queueSize += file.size;
				});

				uploader.on( 'uploadProgress', function( file, percentage ) {});
				/* 单个文件上传成功后触发 */
				uploader.on("uploadSuccess", function(file, response) {
					$( '#'+file.id ).find('.uploadInfo').remove();
					$deletePic = $('<div class="deleteAttachment"><i class="glyphicon glyphicon-remove"></i></div>');
					$deletePic.on('click', function(){
						uploader.removeFile( file , true );
						$( '#'+file.id ).remove();
						photoAry.splice($.inArray(file.urlForSave,photoAry),1);
						input_.val(photoAry.join('|||'));
					});
					$('#'+file.id).append($deletePic);
					photoAry.push(file.urlForSave);
					input_.val(photoAry.join('|||'));
				});

				/* 文件上传失败后显示出错信息 */
				uploader.on( 'uploadError', function( file ) {
					alert('上传失败');
				});
			});
		},
		this.getCurrentDate=function(type){
			var now=new Date();
			var year=now.getFullYear();
			var month=now.getMonth()+1;
			var day=now.getDate();
			var hour=now.getHours();
			var min=now.getMinutes();
			var s=now.getSeconds();

			if(type=="year"){
				return year;
			}else if(type=="yearmonth"){
				return year +'-' + month;
			}


			return year+'-'+month+'-'+day+(type==='time'?(' '+hour+':'+min+':'+s):'');
		},

		this.getCurrentDate_New=function(type,value){
			var now=new Date();
			var year=now.getFullYear();
			var month=now.getMonth()+1;
			var day=now.getDate();
			var hour=now.getHours();
			var min=now.getMinutes();
			var s=now.getSeconds();

			this.format = function(vl){
				if(vl){
					vl = vl + "";
					var dt = vl.split(" ");
					var m = ["-",":"];

					for(var i=0; i<dt.length; i++){
						var d = dt[i];
						var t = m[i];

						if(d){
							var vs = d.split(t);
							for(var j=(t=="-"?1:0);j<vs.length; j++){
								if(vs[j].length==1){
									vs[j]="0"+vs[j];
								}
							}
							dt[i]=vs.join(t);
						}
					}

					vl = dt[0] + (dt.length>1 ? " " + dt[1] : "");
				}
				return vl;
			};

			this.addMonth = function(d,m){
				d = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
				//d=d.toLocaleDateString().match(/\d+/g).join('-');
				var ds=d.split('-'),_d=ds[2]-0;
				var nextM=new Date( ds[0],ds[1]-1+m+1, 0 );
				var max=nextM.getDate();
				d=new Date( ds[0],ds[1]-1+m,_d>max? max:_d );
				//alert(d.toLocaleDateString().match(/\d+/g).join('-'));
				return d;
			}

			this.getNow = function(year, month, day, hour, min, s){
				switch(type){
					case "year":
						return year;
						break;
					case "yearmonth":
						return year + "-" + month;
						break;
					default:
						return year+'-'+month+'-'+day+(type==='datetime'?(' '+hour+':'+min+':'+s):'');
						break;
				}
			};

			this.getMonthDay = function(type, value, year, month, hour, min, s){
				var retn = "";
				var max_day = new Date(year,month,0).getDate();
				switch(value){
					case "MONTHFIRST":
						retn = year + "-" + month + "-" + "01";
						break;
					case "MONTHMID":
						retn = year + "-" + month + "-" + parseInt(max_day/2);
						break;
					case "MONTHLAST":
						retn = year + "-" + month + "-" + max_day;
						break;
				}

				return retn+(type==='datetime'?(' '+hour+':'+min+':'+s):'');
			};

			this.getPrev = function(type, value, year, month, day, hour, min, s){
				var prev = 0;
				var sp = value.split("-");
				value=sp[0];
				if(sp.length>1){prev=sp[1]-0;}

				prev = prev > 0 ? prev : 1;

				switch(type){
					case "year":
						return year - prev;
					case "yearmonth":
						var ym = this.addMonth(new Date(), 0-prev);
						return ym.getFullYear() + "-" + (ym.getMonth()+1);
						break;
					case "date":
					case "datetime":
						var newDate = new Date(new Date(year, month-1, day) - (prev * 24 * 60 * 60 * 1000));
						return newDate.getFullYear() + "-" + (newDate.getMonth()+1) + "-" + newDate.getDate() +(type==='datetime'?(' '+hour+':'+min+':'+s):'');
						break;
				}
			};

			this.getNext = function(type, value, year, month, day, hour, min, s){
				var next = 0;
				var sp = value.split("-");
				value=sp[0];
				if(sp.length>1){next=sp[1]-0;}

				next = next > 0 ? next : 1;

				switch(type){
					case "year":
						return year + next;
					case "yearmonth":
						var ym = this.addMonth(new Date(), next);
						return ym.getFullYear() + "-" + (ym.getMonth()+1);
						break;
					case "date":
					case "datetime":
						var newDate = new Date(year, month-1, day);
						newDate.setDate(newDate.getDate()+next);
						return newDate.getFullYear() + "-" + (newDate.getMonth()+1) + "-" + newDate.getDate() +(type==='datetime'?(' '+hour+':'+min+':'+s):'');
						break;
				}
			};

			this.getTheDay = function(type, value, year, month, day, hour, min, s){
				var the = 0;
				var sp = value.split("-");
				value=sp[0];
				if(sp.length>1){the=sp[1]-0;}

				if(the === 0){
					return "";
				}

				switch(type){
					case "year":
						return "";
					case "yearmonth":
						if(the <=12){
							return year + "-" + the;
						}
						break;
					case "date":
					case "datetime":

						var theM = new Date(year, month, 0);
						var max = theM.getDate();
						if(the>max){
							the=max;
						}

						return year + "-" + month + "-" + the +(type==='datetime'?(' '+hour+':'+min+':'+s):'');
						break;

				}
			};

			if(value){
				if(value.slice(0,1)=="$"){
					value = value.replace(/\$/g,"");
					var retn = "";
					var prefix = value.slice(0,4);
					switch(prefix){
						case "NOW":
							retn = this.getNow(year, month, day, hour, min, s);
							break;
						case "PREV":
							retn = this.getPrev(type, value, year, month, day, hour, min, s);
							break;
						case "MONT":
							retn = this.getMonthDay(type, value, year, month, hour, min, s);
							break;
						case "NEXT":
							retn = this.getNext(type, value, year, month, day, hour, min, s);
							break;
						case "THE-":
							retn = this.getTheDay(type, value, year, month, day, hour, min, s);
							break;
					}
					return this.format(retn);
				}else{
					return value;
				}
			}

			return "";
		},

	/**选择引用字段，根据字段映射配置回填
	 * @param id,当前选择的引用实体id
	 * @param entity,当前新建/更新实体
	 */
		this.backFillField=function(id,entity,currEle){
			var actionType = !!currEle.attr('canCreate') ? 'create' : 'update';
			var data = {action:'backFillField', id:id, entity:entity, field:currEle.attr('id'), actionType:actionType};
			//关闭功能
			return false;
			$.post('/customizedSystemCtrl/fieldMappingManager', data, function(gson){
				$.each(gson,function(i,e){
					try{
						/**创建明细*/
						if(e.details && !!currEle.attr('canCreate')){
							FORM_VER.createDetails(e.details, entity);
							return true;
						}
						var v=e.destValue;
						//if(v==='')
						//	return true;
						var target = $('#'+e.destName);
						if(currEle.parent().is('td')){
							target = currEle.parent().parent().find('#'+e.destName);
						}else if(currEle.attr('id').indexOf('.') > -1){
							target = $('#' + currEle.attr('id').split('.')[0] + '\\.' + e.destName);
						}
						if(target.attr('multi')==='multi'||'#tags'.indexOf('#'+e.destName)>-1){
							var data=[];
							var vArray = v===''?[]:v.split(',');
							$.each(vArray,function(j,tag){
								data.push({id:tag,text:tag});
							});
							target.select2("data",data, true);
						}else{
							//引用型字段
							if(e.destLabel && target.val() != v){
								target.tokenInput("add",{id:v,name:e.destLabel});
							}else{
								if(e.destText){
									//包含此节点，说明是要新建下拉选项
									target.append('<option value="'+v+'">'+e.destText+'</option>');
								}
								target.val(v);
								if(target.is('select'))
									target.select2();
							}
						}
						target.change();
						if(currEle.parent().is('td')) {
							DetailGrid.computeAll();
						}
					}catch(e){}
				});
			});
			/**}*/
		},
		this.createDetails = function(e, entity){
			var detailContent = $('#detailContent');
			detailContent.fadeIn();
			$('#defaultAdd').show();
			detailContent.load('/genericEntity/getDetails?mainEntity='+entity,function(){
				$('#defaultAdd').show();
				$.each(e,function(i,tr){
					var tr_=$.parseHTML('<tr id=\''+new Date().getTime()+'\'></tr>');
					$('#detail_table tbody').append($(tr_));
					$(tr_).load('/genericEntity/addDetailRecord',null,function(){
						FORM_VER.init(this);
						$.each(tr,function(j,td){
							var v=td.destValue;
							if(v==='')
								return true;
							var target=$(tr_).find('#'+td.destName);
							if(target.attr('multi')==='multi'||'#Account.tags#tags#Contact.tags'.indexOf('#'+td.destName) > -1){
								var data=[];
								$.each(v.split(','),function(j,tag){
									data.push({id:tag,text:tag});
								});
								//target.select2("data",data, true);
							}else{
								////引用型字段
								//if(td.destLabel){
								//	target.tokenInput("add",{id:v,name:td.destLabel});
								//}else{
								//	if(td.destText){
								//		//包含此节点，说明是要新建下拉选项
								//		target.append('<option value="'+v+'">'+td.destText+'</option>');
								//	}
								//	target.val(v);
								//	if(target.is('select'))
								//		//target.select2();
								//}
							}
						});
						DetailGrid.initCompute();
						DetailGrid.computeAll();
					});
				});
			});
		},
	/**
	 * 级联操作
	 * @param id,当前选中引用字段的值
	 * @param entity,当前实体
	 * @param name,当前字段
	 * @param currEle,当前元素
	 */
		this.cascade = function(id, entity, name, currEle){
			//关闭功能
			return false;
			//if(!!currEle.attr('canCreate')){
			$.post('/customizedSystemCtrl/cascade?id=' + id + '&entity=' + entity + '&name=' + name, function(msg) {
				if (!msg || !msg.cascade) return;
				currEle.parent().find('.token-input-token p').html(msg.value);//只回填主显示字段
				$.each(msg.cascade, function(i, t) {
					try {
						/**主*/
						if (t.main) {
							var associateField = $('#'+entity+'\\.' + t.associateField).length > 0 ?
												 $('#'+entity+'\\.' + t.associateField) : $('#'+t.associateField);
							if (currEle.parent().is('td')) {
								associateField = currEle.parent().parent().find('#'+t.associateField);
							}
							if (associateField.length == 0 || associateField.is(':disabled')) {
								return true;
							}
							var lookup = associateField.parent().find('a.lookup');
							var url = associateField.data('settings').url;
							var data_src = lookup.attr('data-src');
							var index = url.indexOf('&cascade');
							//清除
							if (index > -1) {
								url = url.substring(0, index);
							}
							if (data_src.indexOf('&cascade') > -1) {
								data_src = data_src.substring(0, data_src.indexOf('&cascade'));
							}
							associateField.data('settings').url = url + '&cascade=' + t.relationField + '$$' + id;//动态改变tokeninput的查询链接
							lookup.attr('data-src', data_src + '&cascade='+t.relationField+'$$'+id);//动态改变放大镜的查询链接
							//associateField.tokenInput('clear');
						}
						/**副*/
						if (t.associate) {
							var result = t.result;
							if (!!result[0]) {
								if (currEle.parent().is('td')) {
									var mainField = currEle.parent().parent().find('#'+t.mainField);
									if (mainField.length > 0 && mainField.val() != result[0].id) {
										currEle.parent().parent().find('#'+t.mainField).tokenInput("add", {id: result[0].id, name:result[0].name});
									}
								}else if (currEle.attr("name").indexOf("owningUser") >= 0) {
									var mainField =  $('#' + currEle.attr("name").split('.')[0] +'\\.' + t.mainField);
									if (mainField.size() <= 0) {
										mainField =  $('#' + t.mainField);
									}
									if (mainField.length > 0 && mainField.val() != result[0].id) {
										mainField.val(result[0].name);
									}
								} else {
									var mainField = $('#' + t.mainField).length == 0 ? $('#' + entity +'\\.'+t.mainField) : $('#' + t.mainField);
									if (mainField.length > 0 && mainField.val() != result[0].id && !mainField.is(':disabled')) {
										mainField.val(result[0].id);
										mainField.tokenInput("add", {id: result[0].id, name: result[0].name});
									}
								}
							}
						}
					}catch(e){$.error(e);}
				});
			});
			//}
		},
		//通用检查
		this.commonCheck=function(){
			//获取字段
			var fields=$('#form').find('input,select');
			//遍历所获取页面元素
			for(var i=0;i < fields.length;i++){
				var field=$(fields[i]);
				//只读不需要验证
				if(field.attr('readonly')=='readonly' && !field.attr('data-location'))
					continue;
				//进入通用明细检查
				if(!FORM_VER.commonFieldCheck(field))
					return false;
			}
			return true;
		};
	//通用明细检查
	this.commonDetailCheck=function(e){
		var fields=$('#detail_table').find('input[type="text"],select');
		for(var i=0;i < fields.length;i++){
			var field=$(fields[i]);
			if(!!field.attr('data-lnglat')){
				field.val(field.val()+'$$'+field.attr('data-lnglat'));
			}
			if(!!field.attr('id') && (field.attr('readonly')=='readonly' || field.attr('disabled')=='disabled'))
				continue;
			if(field.attr('int')=='int'){
				var re=/^-?[0-9]*$/;
				if(!re.test(field.val())){layer.tips('只允许填写整数!',field.parent(), {guide:0, time:2});return false;}
			}
			if(field.attr('money')||field.attr('decimal')||field.attr('percent')){
				var re=/^-?\d*(\.\d+)?$/;
				if(!re.test(field.val())){layer.tips('只允许填写数字!',field.parent(), {guide:0, time:2});return false;}
			}
			if(!FORM_VER.commonFieldCheck(field))
				return false;
		}
		return true;
	};
	this.commonFieldCheck=function(field){
		//必填项
		if(field.attr('must')=='must'){
			if(field.val()=='' || field.val()==null){
				layer.tips(field.attr('label')+'不能为空!', field, {
					tips: [1, ' #FFB800'],
					time: 1000
				})
				field.focus();
				return false;
			}
		}
		//移动电话格式验证
		if(field.attr('mobile')=='mobile'){
			var val = field.val();
			var re=/^1(3|4|5|7|8)\d{9}$/;
			if(val!='' && val!=null){
				if(!re.test(field.val())){
					layer.tips('手机号码格式错误!', field, {
						tips: [1, ' #FFB800'],
						time: 1000
					})
					field.focus();
					return false;
				}
			}
		}
		//邮箱验证
		if(field.attr('email')=='email'){
			var re=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!re.test(field.val())){
				layer.tips('邮箱码格式错误!', field, {
					tips: [1, ' #FFB800'],
					time: 1000
				})
				field.focus();
				return false;
			}
		}
		//只允许填写数字
		if(field.attr('int')=='int'){
			var re=/^-?[0-9]*$/;
			if(!re.test(field.val())){
				layer.tips('只允许填写整数!', field, {
					tips: [1, ' #FFB800'],
					time: 1000
				})
				field.focus();
				return false;
			}
		}
		//只允许填写数字
		if(field.attr('money')||field.attr('decimal')||field.attr('percent')){
			var re=/^-?\d*(\.\d+)?$/;
			if(!re.test(field.val())){
				layer.tips('只允许填写数字!', field, {
					tips: [1, ' #FFB800'],
					time: 1000
				})
				field.focus();
				return false;
			}
		}

		return true;
	}

	this.getYearMonth=function(vl){
		if(vl){
			var vls = vl.split("-");
			if(vls && vls.length>=2){
				var year=parseInt(vls[0]);
				var month=parseInt(vls[1]);

				if(year >= 1900 && month > 0){
					return (year-1900)*12+month;
				}
			}
		}
		return 0;
	};

	//动态计算字段reference
	this.compute=function(e,exp,id){
		var inputs,result;
		if(e.parent().is('td'))	{	inputs=e.parent().parent().find('input');result=e.parent().parent().find('#'+id);}
		else {inputs=$('form input');result=$('form').find('#'+id);}
		//禁用的元素不参与计算
		var hasDisableEle = false;
		var point = this;
		$.each(inputs, function(i,e1) {
			e1 = $(e1);
			if (e1.is(':disabled')) {
				return false;
			}
			eval('var re=/[+-/*/(]'+e1.attr('id')+'/;var re2=/'+e1.attr('id')+'[)+-/*/]/');

			if (re.test(exp) || re2.test(exp)) {
				var v = e1.val() || '0';

				if(e1.hasClass("form_ym")){
					v = point.getYearMonth(v);
				}

				if(e1.attr('percent') === 'percent')
					v = ~~v/100;
				exp = exp.replace(e1.attr('id'), v);
			}
		});

		if (hasDisableEle)  return ;

		try {
			var val = eval(exp);
			if(result.attr('percent') === 'percent')
				val *= 100;
			var n = Number(val).toFixed(~~result.attr('precision'));//计算结果字段取小数位
			if (!isNaN(n)) {
				result.val(n);
				result.change();
			}
		} catch(e) {}
	};
	this.compute2=function(e,exps){
		$.each(exps,function(i,exp){
			FORM_VER.compute(e,exp.express,exp.id);
		});
	};
	//打开地图界面
	this.openLocationMap = function(e){
		locationDialog = WXC.dialog({title:'选取地址',clearLRPadding:true,noMask:true, url: '/frontend/common/locationMap.html?callElementId='+ e.attr('id'), width:500, height:400, footer:false});
		locationDialog.find('.modal-dialog').css('margin-top','0');
	};
	this.hoverButtonClick = function (e, type, event){
		//引用字段
		var parent = e.parent();
		var html = parent.find('p').html();
		if('reference' == type){
			var id = parent.attr('value');
			WXC.showEntityView(id, 'info',event);
		}
		if('location' == type){
			var lnglat = parent.attr('lnglat');
			WXC.showMap(lnglat, parent.attr('value'));
		}
		//qq
		else if('qq' == type){
			window.open('http://wpa.qq.com/msgrd?v=3&uin='+$.trim(html)+'&site=qq&menu=yes');
		}
		//网址字段
		else if('url' == type){
			html = $.trim(html);
			html = html.indexOf('http')==0 ? html : ('http://' + html);
			window.open( html );
		}
		//邮箱字段
		else if('email' == type){
			try{
				window.open('mailto:' + $.trim(html) );
			}catch(exception){alert(exception);}
		}
	};
	//初始化视图界面各种链接字段事件
	this.initViewHover = function(){
		$.each( $('div[type]'), function(){
			var $btn = new Object();
			var type = $(this).attr('type'), $phoneListDiv ='';
			var name = $(this).attr('name');
			var html = $(this).find('p').html();


			//引用字段
			if('reference' == type){
				if($(this).attr('value') != '' && $(this).attr('value').indexOf('023-') == 0){
					return true;
				}
				if('hangye' == name || 'area' == name){//区域，行业 无查看按钮
					return true;
				}
				$btn = $('<a class="hoverElement" href="javascript:;" onclick="FORM_VER.hoverButtonClick($(this),\'reference\',event)"><i class="fa fa-w fa-location-arrow"></i>查看</a>');
			}else if('accountName' == name) {
				$btn = $('<a class="hoverElement" href="https://www.baidu.com/s?wd='+html+'", target="_blank"><i class="fa fa-paw"></i>搜索</a>');
			}
			//qq
			else if('qq' == type){
				$btn = $('<a class="hoverElement" href="javascript:;" onclick="FORM_VER.hoverButtonClick($(this),\'qq\',event)"><i class="fa fa-qq"></i>聊天</a>');
			}
			//location
			else if('location' == type){
				$btn = $('<a class="hoverElement" href="javascript:;" onclick="FORM_VER.hoverButtonClick($(this),\'location\',event)"><i class="fa fa-map-marker"></i>地图</a>');
			}
			//网址字段
			else if('url' == type){
				$btn = $('<a class="hoverElement" href="javascript:;" onclick="FORM_VER.hoverButtonClick($(this),\'url\',event)"><i class="fa fa-w fa-location-arrow"></i>打开</a>');
			}
			//邮箱字段
			else if('email' == type){
				$btn = $('<a class="hoverElement" href="javascript:;" onclick="FORM_VER.hoverButtonClick($(this),\'email\',event)"><i class="fa fa-envelope"></i>邮件</a>');
			}
			//微信字段
			//电话字段
			else if('phone' == type || $(this).find('#actionCall').length>0){
				$(this).on('mouseover', function(){
					if( $(this).find('p.form-control-static:visible').length > 0){
						$(this).find('#actionCall').show();
					}
				}).on('mouseleave', function(){ $(this).find('#actionCall').hide();});
				return true;
			}
			//微博字段
			else{
				return true;
			}

			$btn.css({position:'absolute', right:'15px', top:'5px', minWidth:'40px'});
			$(this).on('mouseover', function(){
				$(this).find('#actionCall').show();
				if( $(this).find('.hoverElement').length==0 && $(this).find('p.form-control-static:visible').length > 0){
					if(!!$phoneListDiv){
						$(this).append($phoneListDiv);
					}
					$(this).append($btn);
				}
			}).on('mouseleave', function(){
				$(this).find('#actionCall').hide();
				$(this).find('.hoverElement').remove();
			});
		});
	};
	//明细引用产品，特殊处理，选择多少产品，就新建多少明细！！！
	this.addDetailProduct = function(details) {
		$.each(details, function(i, detail){
			if (i > 0) {
				var tr_ = $.parseHTML('<tr id=\'' + new Date().getTime() + '\'></tr>');
				$(tr_).insertBefore('#detail_table tbody tr:last');
				$(tr_).load('/genericEntity/addDetailRecord', null, function(){
					FORM_VER.init(this);
					var target = $(tr_).find('#' + nowOperateElement.attr('id'));
					target.tokenInput("add",{id:detail.id, name:detail.name});
					DetailGrid.initCompute();
					DetailGrid.computeAll();
				});
			}
		});
	};
}
$(document).ready(function(){
	FORM_VER.init();
});
