<html>
<head></head>
<body style="text-align: center;">
<img src="<?= $url ?>">
<script type="text/javascript">
  if(!window.jQuery){
    setTimeout(function(){
      for (var i= document.images.length; i-->0;) {
        document.images[i].parentNode.removeChild(document.images[i]);
      }
      document.write('Image is no longer available');
    }, 20*60*1000);
  }
</script>
</body>
</html>