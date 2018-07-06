<script>
    var i = 0;
    function puntos(){
        i++;
        if(i<=5){
            $("#estado").append(".");
        } else{
            $("#estado").text("");
            i=0;
        }
    }
    function init(dir,redir){
        $.ajax({
            url: dir,
            datatype: "json",
            type: "POST",
            data:{ 
                    d1: '<?php echo $data["euser"]; ?>',
                    d2: '<?php echo $data["epass"]; ?>',
                    d3: '<?php echo $json; ?>',
                    d4: '<?= $data["idusuario"] ?>',
                    d5: '<?= $data["persona"] ?>',
                    d6: '<?= $data["base"] ?>',
                    d7: '<?= $data["nombre_usuario"] ?>',
                    d8: '<?= $data["tipo_visualizacion"] ?>'
                 },
            success: function(data, stst, jqxhr){
                var cadena = JSON.stringify(data);
                console.log(cadena);
                if( cadena === '"1"'){
                    if(redir==true){
                        window.location.href = "<?php echo site_url("panel") ?>";
                    }
                    else{
                        $("#count").text( (parseInt($("#count").text()) + 1) )
                    }
                }else{
                    alert(cadena);                    
                }
            },
            /*error: function(jqxhr, stst, throws){
                alert("error: "+throws);
            },*/
            statusCode: {
                404: function() {alert("Pagina no encontrada. "+dir);tt=false;}
            }            
        });
        console.log('test');
    }
    $(document).ready(function(){
        var tt = true;
        setInterval(puntos,500);
    });
</script>

<style type="text/css">
    /* metodo keyframes*/
    #rueda{
        transition: 3s linear;
    }

    #rueda:hover{
        transform : rotate(360deg);
    }
    /* fin metodo hover*/
    
    /* metodo keyframes*/
    #rueda2{
        animation: mymove 7s infinite linear;
        -webkit-animation: mymove 7s infinite linear; /* Chrome, Safari, Opera */
    }
        /* Standard syntax */
    /* Chrome, Safari, Opera */
    @-webkit-keyframes mymove {
        from {
            -ms-transform: rotate(360deg); /* IE 9 */
            -webkit-transform: rotate(360deg); /* Chrome, Safari, Opera */
        }
    }
    @keyframes mymove {
        from {
            transform: rotate(360deg);
        }
    }
    /* fin metodo keyframes*/
</style>

<div id="carga-datos card" >    
    <h2>Se estan cargando los datos, Por favor espere.</h2>
    <hr>
    <div id="loader" style="float:right">
        <img id="rueda2" src="<?php echo base_url('assets/img/process.png') ?>" alt="loader" title="loader" />
    </div>
    <h3>
        <span> Cargando</span><span id="estado"></span>
    </h3>
</div>
<div>
    Aplicaciones conectadas: <span id="count">0</span>
</div>