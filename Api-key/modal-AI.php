<button onclick="abrirIA()" style="position:fixed;bottom:20px;right:20px;z-index:999;">
 IA Video
</button>

<div id="modalIA" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:1000;">
    <div style="background:white;padding:20px;width:400px;margin:100px auto;border-radius:10px;">
        <h3>Generar Video con IA</h3>
        
        <textarea id="prompt" placeholder="Escribe tu prompt..." style="width:100%;height:80px;"></textarea>
        
        <br><br>
        <button onclick="generar()">Generar</button>
        <button onclick="cerrarIA()">Cerrar</button>

        <div id="resultado" style="margin-top:15px;"></div>
    </div>
</div>