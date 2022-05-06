<head>
    <link rel="stylesheet" href="style.css">
</head>

<!-- 新着情報 -->
<div class="wrapper">
    <div id="news_parent" class="back_ground_color_light_pink visible_960">
        <div class="back_ground_color_white max_width_920 p_10">
            <div id="contents">
                <link rel="stylesheet" href="contents-maker/css/style.css">
                <p id="large-title">What's new</p>
                <div id="news"></div>
            </div>
        </div>
    </div>
</div>

<script src="//unpkg.com/vue"></script>
<script src="contents-maker/js/contents-maker.js" id="contents-maker-js" async></script>
<script>
	function show_contents(id){
        var contents = document.getElementById('input-contents-'+id);
        contents.style.WebkitLineClamp = '1000';
    }
</script>