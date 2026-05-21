<?php $basePath = $basePath ?? ''; ?>

<div class="a11y-backdrop" id="a11y-backdrop" hidden aria-hidden="true"></div>

<aside class="a11y-widget" id="a11y-widget" aria-label="Herramientas de accesibilidad">
    <button type="button"
            class="a11y-fab"
            id="a11y-fab"
            aria-expanded="false"
            aria-controls="a11y-panel"
            aria-haspopup="dialog"
            title="Opciones de accesibilidad">
        <span class="a11y-fab-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" focusable="false">
                <path d="M12 2c1.5 0 2.5 1.1 2.5 2.5S13.5 7 12 7 9.5 5.9 9.5 4.5 10.5 2 12 2zm-1.2 7.2h2.4l.4 9.8H10.4l.4-9.8zm1.2 11.3c-1.2 0-2.1-.9-2.1-2.1s.9-2.1 2.1-2.1 2.1.9 2.1 2.1-.9 2.1-2.1 2.1z"/>
            </svg>
        </span>
        <span class="a11y-fab-label">Accesibilidad</span>
    </button>

    <div id="a11y-panel"
         class="a11y-panel"
         role="dialog"
         aria-labelledby="a11y-panel-title"
         aria-modal="true"
         hidden>

        <header class="a11y-panel-header">
            <div>
                <h2 class="a11y-panel-title" id="a11y-panel-title">Accesibilidad</h2>
                <p class="a11y-panel-desc">Personaliza cómo ves el sitio. Se guarda en tu navegador.</p>
            </div>
            <button type="button" class="a11y-panel-close-icon" id="a11y-close-top" aria-label="Cerrar panel">
                <span aria-hidden="true">×</span>
            </button>
        </header>

        <div class="a11y-panel-body">
            <div class="a11y-section">
                <h3>Tamaño de texto</h3>
                <div class="a11y-actions a11y-actions--3">
                    <button type="button" class="a11y-btn" id="a11y-font-dec">
                        <span class="a11y-btn-icon" aria-hidden="true">A−</span>
                        <span>Mermar</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-font-reset">
                        <span class="a11y-btn-icon" aria-hidden="true">A</span>
                        <span>Normal</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-font-inc">
                        <span class="a11y-btn-icon" aria-hidden="true">A+</span>
                        <span>Agrandar</span>
                    </button>
                </div>
            </div>

            <div class="a11y-section">
                <h3>Tema</h3>
                <div class="a11y-actions a11y-actions--3">
                    <button type="button" class="a11y-btn" id="a11y-theme-light" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">☀️</span>
                        <span>Claro</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-theme-dark" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">🌙</span>
                        <span>Oscuro</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-theme-system" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">💻</span>
                        <span>Sistema</span>
                    </button>
                </div>
            </div>

            <div class="a11y-section">
                <h3>Visualización</h3>
                <div class="a11y-actions a11y-actions--2">
                    <button type="button" class="a11y-btn" id="a11y-contrast" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">◐</span>
                        <span>Contraste</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-grayscale" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">◎</span>
                        <span>Grises</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-underline" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">U̲</span>
                        <span>Enlaces</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-readable" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">Aa</span>
                        <span>Legible</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-spacing" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">↔</span>
                        <span>Espacio</span>
                    </button>
                    <button type="button" class="a11y-btn" id="a11y-line-height" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">≡</span>
                        <span>Interlineado</span>
                    </button>
                </div>
            </div>

            <div class="a11y-section">
                <h3>Movimiento</h3>
                <div class="a11y-actions a11y-actions--1">
                    <button type="button" class="a11y-btn a11y-btn--full" id="a11y-motion" aria-pressed="false">
                        <span class="a11y-btn-icon" aria-hidden="true">⏸</span>
                        <span>Reducir animaciones</span>
                    </button>
                </div>
            </div>
        </div>

        <footer class="a11y-footer-actions">
            <button type="button" class="a11y-btn-wide a11y-btn-reset" id="a11y-reset">Restablecer</button>
            <button type="button" class="a11y-btn-wide a11y-btn-close" id="a11y-close">Cerrar</button>
        </footer>
    </div>
</aside>

<script src="<?= App\Utils\Sanitizer::escape($basePath) ?>js/accessibility.js"></script>
