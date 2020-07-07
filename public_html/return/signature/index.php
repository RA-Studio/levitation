<?
require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');
CModule::IncludeModule("iblock");

$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "CODE" => $_REQUEST['ORDER_ID'], "PROPERTY_UF_STATUS" => "Отправлено");
$res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array("nPageSize"=>1), Array("ID", "IBLOCK_ID", "PROPERTY_*", "CODE"));
global $USER;
while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arFields['PROPERTIES'] = $ob->GetProperties();
}
if(!$arFields || !$_REQUEST['ORDER_ID'] || !$arFields['PROPERTIES']['UF_ORDER']['VALUE']) {
    ?><div style="font-size: 24px;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);    text-align: center;">Ссылка больше не действительна. Необходимо перевыпустить</div><?
    die();
}

?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="draw-canvas-container">
        <div class="draw-canvas-wrap">
            <div class="draw-canvas"></div>
            <div class="draw-canvas-wrap__placeholder">
        		<img src="" alt="">
        		<span>Начните подписывать в этой области</span>
        	</div>
        </div>
    </div>
    1
    <img src="" alt="">
    <div class="page-loader-overlay" style="display: none"><svg width="38" height="38" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="#bbb" class="page-loader__svg"><g fill="none" fill-rule="evenodd"><g transform="translate(1 1)" stroke-width="2"><circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle> <path d="M36 18c0-9.94-8.06-18-18-18" transform="rotate(210.528 18 18)"><animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform></path></g></g></svg></div>
    <div class="page-resize">
    	<span>Пожалуйста, переверните устройство</span>
    	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="444.704px" height="444.705px" viewBox="0 0 444.704 444.705" style="enable-background:new 0 0 444.704 444.705;" xml:space="preserve">
			<g>
				<g>
					<path d="M90.997,86.881h28.2c1.396,0,2.515-1.119,2.515-2.505c0-1.387-1.119-2.525-2.515-2.525h-28.2    c-1.396,0-2.515,1.138-2.515,2.525C88.482,85.762,89.601,86.881,90.997,86.881z"/>
					<path d="M423.265,325.751v-28.199c0-1.387-1.118-2.506-2.515-2.506c-1.387,0-2.505,1.119-2.505,2.506v28.199    c0,1.396,1.118,2.525,2.505,2.525C422.146,328.277,423.265,327.158,423.265,325.751z"/>
					<path d="M0,412.791c0,14.152,11.504,25.664,25.656,25.664h158.881c9.429,0,17.644-5.125,22.07-12.736    c2.658-4.561,7.459-8.961,12.747-8.961h199.693c14.144,0,25.656-11.502,25.656-25.646v-158.89    c0-14.153-11.504-25.656-25.656-25.656H220.062c-5.279,0-9.562,2.247-9.562,5.011s4.283,5.011,9.562,5.011h198.985    c8.606,0,15.625,7.019,15.625,15.635v158.88c0,8.607-7.009,15.617-15.625,15.617H219.756c-5.278,0-9.562-2.219-9.562-4.963    c0-2.736,4.284-4.963,9.562-4.963h180.712c1.396,0,2.516-1.119,2.516-2.506v-165.26c0-1.387-1.119-2.505-2.516-2.505H219.756    c-5.278,0-9.562-4.284-9.562-9.562V86.097c0-14.162-11.504-25.666-25.656-25.666H25.656C11.514,60.431,0,71.935,0,86.097V412.791z     M219.756,231.533H388.41c5.278,0,9.562,4.283,9.562,9.562v141.123c0,5.279-4.284,9.562-9.562,9.562H219.756    c-5.278,0-9.562-4.283-9.562-9.562V241.095C210.193,235.816,214.468,231.533,219.756,231.533z M200.162,86.097v326.694    c0,8.625-6.999,15.635-15.625,15.635H25.656c-8.606,0-15.625-7-15.625-15.635V86.097c0-8.606,7.009-15.635,15.625-15.635h158.881    C193.153,70.462,200.162,77.48,200.162,86.097z"/>
					<path d="M19.957,104.657v286.817c0,1.387,1.119,2.506,2.505,2.506h165.259c1.396,0,2.515-1.119,2.515-2.506V104.657    c0-1.377-1.118-2.505-2.515-2.505H22.462C21.076,102.152,19.957,103.28,19.957,104.657z M34.54,107.163h141.114    c5.278,0,9.562,4.284,9.562,9.562v262.692c0,5.277-4.284,9.562-9.562,9.562H34.54c-5.278,0-9.562-4.285-9.562-9.562V116.725    C24.978,111.447,29.252,107.163,34.54,107.163z"/>
					<path d="M119.541,399.718H90.653c-5.929,0-10.758,4.818-10.758,10.758v1.721c0,5.938,4.829,10.758,10.758,10.758h28.888    c5.929,0,10.758-4.82,10.758-10.758v-1.721C130.299,404.537,125.47,399.718,119.541,399.718z M125.288,412.187    c0,3.176-2.572,5.748-5.747,5.748H90.653c-3.156,0-5.747-2.582-5.747-5.748v-1.721c0-3.156,2.591-5.738,5.747-5.738h28.888    c3.175,0,5.747,2.582,5.747,5.738V412.187z"/>
					<path d="M258.14,15.363c-14.4-6.053-29.662-9.113-45.354-9.113c-29.644,0-57.939,10.959-79.666,30.896    c0,0-0.268,0.239-0.622,0.564c-0.334,0.315,0.909,2.218,2.773,4.255c1.874,2.056,3.672,3.433,4.006,3.136l0.622-0.564    c19.881-18.227,45.757-28.257,72.886-28.257c14.344,0,28.305,2.802,41.482,8.329c43.892,18.417,69.959,63.237,65.378,109.615    c-0.363,3.682-3.729,5.757-7.267,4.686l-9.065-2.744c-3.529-1.081-4.982,0.688-3.242,3.939l12.623,23.648    c1.74,3.251,5.785,4.485,9.046,2.745l23.639-12.623c3.261-1.74,3.031-4.016-0.507-5.097l-10.031-3.041    c-3.538-1.062-5.862-4.896-5.441-8.559C335.357,85.762,306.736,35.76,258.14,15.363z"/>
				</g>
			</g>
		</svg>
    </div>
    <div id="sucssec-block" class="sucssec-block">
        <div class="sucssec-line">
            <?if($_GET['mode'] == "ipoteka"):?>
                Ваша подпись принята, продолжить заполнение <br><a href="/ipoteka/"> Ипотеки</a>.
            <?else:?>
                Ваша подпись принята, подробности в вашем ЛК.<br><a href="/return/?ORDER_ID=<?=$arFields['PROPERTIES']['UF_ORDER']['VALUE']?>">Продолжить заполнение</a>
            <?endif?>
            
        </div>
    </div>
    <style>
        .sucssec-block {
            font-size: 24px;
            position: absolute;
            left: 0;
            top: 0;
            background: white;
            width: 100%;
            height: 100%;
            text-align: center;
            z-index: 10;
            display: none;
            font-family: "Myriad Pro";
        }
        .sucssec-line {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        .sucssec-line a{
            color: rgb(253, 120, 0);
        }
		.page-resize{
			position: fixed;
			top: 0;
			left: 0;
			z-index: 99999;
			width: 100%;
			height: 100%;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;
			display: none;
			-webkit-flex-direction: column;
			-moz-flex-direction: column;
			-ms-flex-direction: column;
			-o-flex-direction: column;
			flex-direction: column;
			justify-content: center;
			-ms-align-items: center;
			align-items: center;
			background: #fcfcfc;
            font-family: "Myriad Pro";
		    font-style: normal;
		    font-weight: normal;
		    line-height: 19px;
		    padding: 20px;
		    font-size: 20px;
		    text-align: center;
		}
		.page-resize svg{
			width: 100px;
    		height: 100px;
    		margin-top: 20px;
		}
        .page-loader-overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 99999;
            background: #fff;
            opacity: .8;
        }
		.draw-canvas-wrap__placeholder{
			position: absolute;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;
			-webkit-flex-direction: column;
			-moz-flex-direction: column;
			-ms-flex-direction: column;
			-o-flex-direction: column;
			flex-direction: column;
			-ms-align-items: center;
			align-items: center;
			justify-content: center;
			width: 100%;
			height: 100%;
			font-family: "Myriad Pro";
			font-weight: bold;
			font-size: 20px;
			color: #9a9a9a;
		}
        .page-loader__svg {
            margin-left: -32px;
            margin-top: -32px;
            position: absolute;
            top: 50%;
            left: 50%;
        }

        body{
            margin: 0;
        }
        *{
            box-sizing: border-box;
        }
        .draw-canvas-container{
            background: rgb(255, 255, 255);
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
        }

        .draw-canvas-wrap{
            background: white;
            display: flex;
            width: calc(100vw - 20px);
            height: calc(100vh - 75px);
            justify-content: center;
            -ms-align-items: center;
            align-items: center;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.39) 0px 0px 4px 0px;
            position: relative;
            background: rgb(238, 238, 238);
        }
        .draw-canvas{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column-reverse;
            -ms-align-items: center;
            align-items: center;
        }
        .draw-canvas-info{
            width: 100%;
        }
        .draw-canvas canvas{
        	position: relative;
        	z-index: 2
        }
        .confirm,
        .clear{
            cursor: pointer;
            height: 30px;
		    font-size: 16px;
		    border-radius: 3px;
		    font-family: "Myriad Pro";
		    font-style: normal;
		    font-weight: normal;
		    line-height: 20px;
		    text-align: center;
		    padding: 0 15px;
		    position: absolute;
		    z-index: 10;
		    top: 10px;
        }
        .confirm{
        	color: rgb(255, 255, 255);
        	background: rgb(253, 120, 0);
		    border: 1px solid rgb(253, 120, 0);
		    right: 10px;

        }
        .clear{
        	background-color: rgb(255, 255, 255);
        	background-image: url(refresh.png);
        	background-position: center;
        	background-repeat: no-repeat;
        	background-size: 70%;
    		border: 1px solid rgb(253, 120, 0);
    		color: rgb(253, 120, 0);
    		left: 10px;
        }
    </style>
    <script>
        class signature {
            constructor(block, order_id, sign) {
                this.action().init(block);
                this.order_id = order_id;
                this.sign = sign;
                this.interval = false;
                this.canvas              = block.querySelector(`canvas`);
                this.clear               = block.querySelector(`.clear`);
                this.send                = block.querySelector(`.send`);
                this.img                 = block.querySelector(`img`);
                this.text                = block.querySelector(`.text`);
                this.conf                = block.querySelector(`.confirm`);
                this.canvastop           = this.canvas.offsetTop;
                this.canvasleft          = this.canvas.offsetLeft;
                this.minus               = 0;
                this.context             = this.canvas.getContext("2d");
                this.lastx;
                this.lasty;
                this.context.strokeStyle = "#4954B9";
                this.context.lineJoin    = this.context.lineCap = 'round';
                this.context.lineWidth   = 5;
                this.event();
                this.action().clear();
            }
            checkWindow() {
				if(this.action().windowInfo().x < this.action().windowInfo().y){
					document.querySelector(`.page-resize`).style.display = "flex";
				}
            }
            event(){
                var _this = this;

                document.ontouchmove = function(e){
                    e.preventDefault();
                };
                _this.clear.onclick = () => {
                    this.action().clear();
                };
                window.onresize = () => {
                    this.canvastop           = this.canvas.offsetTop;
                    this.canvasleft          = this.canvas.offsetLeft;
                };
                window.onorientationchange = () => {
                	document.querySelector(`.draw-canvas canvas`).remove();
                    if(this.action().windowInfo().x < this.action().windowInfo().y){
                    	document.querySelector(`.page-resize`).style.display = "flex";
					}

					location.href=location.href;
                };
                _this.conf.onclick = () => {
                    this.action().conf();
                };

                setInterval(() => {
                    this.canvastop           = this.canvas.offsetTop;
                    this.canvasleft          = this.canvas.offsetLeft;
                }, 100)

                _this.canvas.ontouchstart = function(e){
                    e.preventDefault();
                    console.log(e.touches[0]);
                    _this.lastx = e.touches[0].clientX - _this.canvasleft;
                    _this.lasty = e.touches[0].pageY - _this.canvastop - _this.minus;
                    _this.action().dot(_this.lastx,_this.lasty);
                };

                _this.canvas.ontouchmove = function(e){
                    e.preventDefault();
                    let newx = e.touches[0].clientX - _this.canvasleft;
                    let newy = e.touches[0].pageY - _this.canvastop - _this.minus;
                    _this.action().line(_this.lastx,_this.lasty, newx,newy);
                    _this.lastx = newx;
                    _this.lasty = newy;
                };

                _this.canvas.onmousemove = function(e){
                    if (e.buttons > 0) {
                        e.preventDefault();
                        _this.action().line(e.offsetX, e.offsetY, e.offsetX - e.movementX, e.offsetY - e.movementY);
                    }
                };
            }
            action() {
                var _this = this;
                return {
                    conf() {

                        let rotateAndCache = function(image, angle) {
                            var offscreenCanvas = document.createElement('canvas');
                            var offscreenCtx = offscreenCanvas.getContext('2d');
                            offscreenCanvas.width = image.height;
                            offscreenCanvas.height = image.width;
                            offscreenCtx.translate(offscreenCanvas.width / 2, offscreenCanvas.height / 2);
                            offscreenCtx.rotate(angle * Math.PI / 180);
                            offscreenCtx.drawImage(image, -(image.width / 2), -(image.height / 2));
                            return offscreenCanvas;
                        }

                        let newCanvas = false;
                        var canvasData = false;

                        let windowsInformation = _this.action().windowInfo();
                        if(windowsInformation.x > windowsInformation.y) {
                            canvasData = _this.canvas.toDataURL("image/png");
                        } else {
                            newCanvas = rotateAndCache(_this.canvas, -90);
                            canvasData = newCanvas.toDataURL("image/png");
                        }

                        var data = new FormData();
                        var xhr = new XMLHttpRequest();
                        data.append('img', canvasData);
                        data.append('order_id', _this.order_id);
                        data.append('sign', JSON.stringify(_this.sign));
                        document.querySelector(`.page-loader-overlay`).style.display = `block`;
                        xhr.open('POST', "/return/signature/ajax.php?action=ConfirmSignature", true);
                        xhr.onload = function() {
                            console.log(this.response);
                            let data = JSON.parse(this.response);
        
                            if(data.isSuccess) {
                                document.getElementById(`sucssec-block`).style.display = "block";
                                document.querySelector(`.page-loader-overlay`).style.display = `none`;;
                            } else {alert(`Произошла ошибка`);}
                        };
                        xhr.send(data);

                    },
					windowInfo() {
                            let arr = {};
                            var w=window,
                                d=document,
                                e=d.documentElement,
                                g=d.getElementsByTagName('body')[0];

                            arr.x = w.innerWidth||e.clientWidth||g.clientWidth;
                            arr.y = w.innerHeight||e.clientHeight||g.clientHeight;
                            return arr;
                    },
                    initDraw() {

                    },
                    clear() {
                        _this.context.clearRect(0, 0, 2000, 2000);
                        _this.context.fillStyle = "#ffffff00";
                        _this.context.rect(0, 0, 2000, 2000);
                        _this.context.fill();
                    },
                    dot(x,y) {
                        _this.context.beginPath();
                        _this.context.fillStyle = "#547CA8";
                        _this.context.arc(x,y,1,0,Math.PI*2,true);
                        _this.context.fill();
                        _this.context.stroke();
                        _this.context.closePath();
                    },
                    line(fromx,fromy, tox,toy) {
                        _this.context.beginPath();
                        _this.context.moveTo(fromx, fromy);
                        _this.context.lineTo(tox, toy);
                        _this.context.stroke();
                        _this.context.closePath();
                    },
                    send() {
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', "/ajax/?act=Order.SendConfirmation", true);
                        xhr.onload = function(){
                            let res = JSON.parse(this.response);
                            if(res.isSuccess) {
                                var canvasData = _this.canvas.toDataURL("image/png");
                                _this.img.setAttribute('src', canvasData);
                                _this.img.style.display = "block";
                                _this.canvas.style.display = "none";
                                _this.text.style.display = "block";
                                _this.conf.style.display = "block";
                            }
                        };
                        xhr.send();
                    },
                    setAttributButtm(clasS, name) {
                        let button = document.createElement(`button`);
                        button.className =  clasS;
                        button.innerText = name;
                        return button;
                    },
                    init(element) {



                        let box = document.createElement(`div`);
                        box.className = 'draw-canvas-info';

                        let clear = _this.action().setAttributButtm('clear', '');
                        let send = _this.action().setAttributButtm('send', 'Отправить');
                        let conf = _this.action().setAttributButtm('confirm', 'Подтвердить');

                        box.appendChild(conf);
                        box.appendChild(clear);
                        element.appendChild(box);

                        let heightContainer = document.querySelector('.draw-canvas-wrap').clientHeight,
                        	widthContainer = document.querySelector('body').clientWidth - 20;

                        let heightCanvas = heightContainer;

                        let canvas = document.createElement(`canvas`);
                        canvas.setAttribute(`width`, widthContainer);
                        canvas.setAttribute(`height`, heightCanvas);
                        canvas.className = 'draw-canvas-box';

                        canvas.style.borderRadius = "5px";
                        element.appendChild(canvas);

                    },
                }
            }
        }
    </script>
    <script>
        let paintList = document.querySelectorAll(`.draw-canvas`);
        paintList.forEach(function (element) {
            let b =  new signature(element, '<?=$arFields['PROPERTIES']['UF_ORDER']['VALUE']?>', {
                "CODE": '<?=$arFields['CODE']?>',
                "ID": <?=$arFields['ID']?>,
                "IBLOCK_ID": <?=$arFields['IBLOCK_ID']?>,
                "PHONE": <?=preg_replace("/[^0-9]/", '', $arFields['PROPERTIES']['UF_PHONE']['VALUE'])?>
            });
            document.addEventListener("DOMContentLoaded", () => {
            	b.checkWindow();
            });

        });

		document.querySelector('canvas').addEventListener("touchstart", function(){
			document.querySelector('.draw-canvas-wrap__placeholder').remove();
		});

    </script>
</body>

