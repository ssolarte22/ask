<button onclick="abrirIA()" class="btn-flotante-ia">
    <span>:D</span> IA Video
</button>

<div id="modalIA" class="modal-ia-overlay">
    <div class="modal-ia-content">
        <div class="modal-ia-header">
            <h3>Tutor de Video IA</h3>
            <button onclick="cerrarIA()" class="btn-cerrar">&times;</button>
        </div>
        
        <div class="modal-ia-body">
            <p><small>Describe el tema del video y la IA generará el guion y el avatar automáticamente.</small></p>
            
            <textarea id="prompt" placeholder="Ej: Explica cómo configurar un router Cisco en 30 segundos..." class="input-prompt"></textarea>
            
            <div class="btn-group-ia">
                <button id="btnGenerar" onclick="generar()" class="btn-ia-principal">GENERAR VIDEO</button>
                <button onclick="cerrarIA()" class="btn-ia-secundario">CANCELAR</button>
            </div>

            <div id="status-container" style="display:none; margin-top:15px; text-align:center;">
                <div class="spinner"></div>
                <p id="status-text" style="font-size: 0.9rem; color: #002244;"></p>
            </div>

            <div id="resultado" style="margin-top:20px; border-top: 1px solid #ddd; padding-top: 15px; display:none;">
                </div>
        </div>
    </div>
</div>

<style>
    /* Estilos del botón flotante */
    .btn-flotante-ia {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 999;
        background: #002244;
        color: #D4AF37;
        border: 2px solid #D4AF37;
        padding: 15px 25px;
        border-radius: 50px;
        font-weight: bold;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .btn-flotante-ia:hover { transform: scale(1.05); background: #003366; }

    /* Estilos del Modal */
    .modal-ia-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 34, 68, 0.8);
        backdrop-filter: blur(4px);
        z-index: 1000;
    }
    .modal-ia-content {
        background: white;
        width: 90%;
        max-width: 450px;
        margin: 80px auto;
        border-radius: 0;
        border: 3px solid #D4AF37;
        overflow: hidden;
        animation: slideIn 0.3s ease-out;
    }
    @keyframes slideIn { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    .modal-ia-header {
        background: #002244;
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-ia-header h3 { margin: 0; font-size: 1.2rem; }
    .btn-cerrar { background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; }

    .modal-ia-body { padding: 25px; }
    .input-prompt {
        width: 100%;
        height: 100px;
        padding: 12px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        resize: none;
        font-family: inherit;
        box-sizing: border-box;
    }

    .btn-group-ia { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .btn-ia-principal { background: #D4AF37; color: #002244; border: none; padding: 12px; font-weight: bold; cursor: pointer; }
    .btn-ia-secundario { background: #666; color: white; border: none; padding: 12px; cursor: pointer; }

    /* Spinner de carga */
    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #002244;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
        margin: 0 auto 10px;
    }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
</style>