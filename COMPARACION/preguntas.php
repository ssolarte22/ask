<?php
$pageTitle = 'Preguntas frecuentes';
$navActive = 'faq';
require __DIR__ . '/inc/legacy-layout-start.php';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <h2>❓ Preguntas Frecuentes (FAQ)</h2>

    <p>
        Resuelve tus dudas sobre la creación de videos con inteligencia artificial.
    </p>

    <hr>

    <!-- ACORDEON -->

    <div class="accordion mt-4" id="accordionFAQ">

        <!-- GENERALES -->

        <div class="accordion-item">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#generales">

                    <strong>📌 Generales</strong>

                </button>

            </h2>

            <div id="generales"
                 class="accordion-collapse collapse"
                 data-bs-parent="#accordionFAQ">

                <div class="accordion-body">

                    <p><strong>1. ¿Necesito experiencia en edición de videos para usar estas herramientas?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> No.
                        <p>Todas las IAs que recomendamos están diseñadas para que cualquier </p>
                        <P>docente,sin conocimientos técnicos, pueda crear un video en minutos</P> 
                        
                    </p>

                    <br>

                    <p><strong>2. ¿Son gratis estas plataformas?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> La mayoría tiene un plan gratuito (freemium)
                        con limitaciones.
                    </p>

                    <br>

                    <p><strong>3. ¿En qué idioma puedo crear los videos?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> La mayoría soporta español e inglés.
                    </p>

                    <br>

                    <p><strong>4. ¿Puedo usar mi propio rostro o voz?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Sí. Algunas plataformas permiten crear avatares
                        y clonar voces.
                    </p>

                </div>

            </div>

        </div>

        <!-- TECNICAS -->

        <div class="accordion-item">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#tecnicas">

                    <strong>📌 Técnicas</strong>

                </button>

            </h2>

            <div id="tecnicas"
                 class="accordion-collapse collapse"
                 data-bs-parent="#accordionFAQ">

                <div class="accordion-body">

                    <p><strong>5. ¿Qué duración máxima tienen los videos?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Depende de la plataforma y del plan usado.
                    </p>

                    <br>

                    <p><strong>6. ¿Dónde se guardan los videos que creo?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Puedes descargarlos como MP4 y subirlos a
                        YouTube o Google Drive.
                    </p>

                    <br>

                    <p><strong>7. ¿Puedo editar un video después de generarlo?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Sí. Plataformas como Runway ML permiten editar videos.
                    </p>

                </div>

            </div>

        </div>

        <!-- ETICA -->

        <div class="accordion-item">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#etica">

                    <strong>📌 Ética y uso en el aula</strong>

                </button>

            </h2>

            <div id="etica"
                 class="accordion-collapse collapse"
                 data-bs-parent="#accordionFAQ">

                <div class="accordion-body">

                    <p><strong>8. ¿Es seguro usar IA con mis alumnos?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Sí, pero debes revisar el contenido generado.
                    </p>

                    <ul>
                        <li>No subir datos personales.</li>
                        <li>Revisar errores de la IA.</li>
                        <li>Informar que el contenido usa IA.</li>
                    </ul>

                    <br>

                    <p><strong>9. ¿Los estudiantes pueden usar estas herramientas?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Depende de la edad y las políticas del colegio.
                    </p>

                    <br>

                    <p><strong>10. ¿Qué hago si la IA genera información incorrecta?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Revisar y corregir antes de mostrar el contenido.
                    </p>

                </div>

            </div>

        </div>

        <!-- PLATAFORMAS -->

        <div class="accordion-item">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#plataformas">

                    <strong>📌 Plataformas específicas</strong>

                </button>

            </h2>

            <div id="plataformas"
                 class="accordion-collapse collapse"
                 data-bs-parent="#accordionFAQ">

                <div class="accordion-body">

                    <p><strong>11. ¿Cuál es la mejor IA para empezar gratis?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> HeyGen e Invideo AI son muy recomendadas.
                    </p>

                    <br>

                    <p><strong>12. ¿Puedo generar videos largos gratis?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> En versiones gratuitas existen limitaciones.
                    </p>

                    <br>

                    <p><strong>13. ¿Dónde aprendo a usar cada plataforma?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> En nuestra plataforma encontrarás cursos y tutoriales.
                    </p>

                </div>

            </div>

        </div>

        <!-- SOPORTE -->

        <div class="accordion-item">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#soporte">

                    <strong>📌 Soporte</strong>

                </button>

            </h2>

            <div id="soporte"
                 class="accordion-collapse collapse"
                 data-bs-parent="#accordionFAQ">

                <div class="accordion-body">

                    <p><strong>14. ¿Tienen soporte técnico?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Puedes escribir al correo
                        soporte@tutorialesia.com
                    </p>

                    <br>

                    <p><strong>15. ¿Puedo obtener certificado?</strong></p>

                    <p>
                        <strong>Respuesta:</strong> Sí. Al finalizar los cursos recibirás
                        un certificado digital.
                    </p>

                </div>

            </div>

        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php require __DIR__ . '/inc/legacy-layout-end.php'; ?>