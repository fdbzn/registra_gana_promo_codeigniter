<footer class="footer pb-3 pb-md-4">
        <div class="row mx-2">
            <div class="col-12 col-md-6 text-footer mx-auto text-center text-sm-center text-md-left text-lg-left">Con Tang quiero más, mucho más  Todos los derechos reservados 2020®</div>
            <div class="col-4 col-md-2 text-footer text-center btns" data-toggle="modal" data-target="#preguntasModalLong">Preguntas frecuentes</div>
            <div class="col-4 col-md-2 text-footer text-center btns" ><a href="<?=base_url()?>politicas" target="_blank" class="btn_legal">  Política de privacidad</a></div>
            <div class="col-4 col-md-2 text-footer text-center btns" ><a href="<?=base_url()?>terminos" target="_blank" class="btn_legal">  Términos y condiciones</a></div>
        </div>
    </footer>
                
    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title ml-auto" id="loginModalLongTitle">Inicia sesión</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="assets/images/close.png" />
            </button>
            </div>
            <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link registra-web-boton active" id="correo-tab" data-toggle="tab" href="#correo" role="tab" aria-controls="correo" aria-selected="true">Te registraste con tu correo</a>
                </li>
                <li class="nav-item">
                <a class="nav-link registra-whats-boton" id="whats-tab" data-toggle="tab" href="#whats" role="tab" aria-controls="whats" aria-selected="false">Te registraste con tu whatsapp</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="correo" role="tabpanel" aria-labelledby="correo-tab">
                    
                <form class="row d-flex mt-5" id='f_login_local' >
                    <div class="col-4 text-right my-auto orangeText">Correo:</div><div class="col-8 my-2"><input type="email" class="form-control" id="email" name="email" required ></div>
                    <div class="col-4 text-right my-auto orangeText">Contraseña:</div><div class="col-8 my-2"><input type="password" class="form-control" id="password" name="password" required ></div>
                    <div class="col-6 olvide mx-auto mb-3 text-right">
                        <a class="orange" href="#" data-toggle="modal" data-target="#recuperaModal"><u>Olvide mi contraseña</u></a>
                    </div>
                    <div class="col-12 text-center">
                        <input class="btn_enviar inicia-sesion-boton" type="image" src="assets/images/btn_inicia.png" alt="Iniciar">
                    </div>
                    <div class="col-12 olvide mb-3 text-center orangeText">
                        ¿Aun no tienes cuenta?&nbsp;<a class="orange reistrate-boton-web" href="#" data-toggle="modal" data-target="#registroModal" ><u>Regístrate</u></a>
                    </div>
                </form>
                
                </div>
                <div class="tab-pane fade" id="whats" role="tabpanel" aria-labelledby="whats-tab">
                    
                <form class="row d-flex mt-5" id="f_whats_login">
                    <div class="col-4 text-right my-auto orangeText">Teléfono a 10 dígitos:</div><div class="col-8 my-2"><input type="tel" class="form-control" name="phone" id="phone" required ></div>
                    <div class="col-4 text-right my-auto orangeText">Contraseña:</div><div class="col-8 my-2"><input type="password" class="form-control" name="password" id="password" required ></div>
                    <div class="col-6 olvide mx-auto mb-3 text-right">
                        <a class="orange" href="#" data-toggle="modal" data-target="#recuperaModal"><u>Olvide mi contraseña</u></a>
                    </div>
                    <div class="col-12 text-center">
                        <input class="btn_enviar" type="image" src="assets/images/btn_inicia.png" alt="Iniciar">
                    </div>
                    <div class="col-12 olvide mb-3 text-center orangeText">
                        ¿Aun no tienes cuenta?&nbsp;<a class="orange" href="#" data-toggle="modal" data-target="#registroModal" ><u>Regístrate</u></a>
                    </div>
                </form>
                    
                </div>
            </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div> 
    
    <!-- Modal Registro -->
    <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title ml-auto" id="registroModalLongTitle">Regístrate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="assets/images/close.png" />
            </button>
            </div>
            <div class="modal-body">
            
            <form id="f_register_local" action="?" method="post" class="row d-flex mt-5">
                <div class="col-4 text-right my-auto orangeText">Nombre:</div><div class="col-8 my-2"><input name="nombre" type="text" class="form-control"  required ></div>
                <div class="col-4 text-right my-auto orangeText">Apellido paterno:</div><div class="col-8 my-2"><input name="apellido" type="text" class="form-control"  required ></div>
                <div class="col-4 text-right my-auto orangeText">Apellido materno:</div><div class="col-8 my-2"><input name="apellido_materno" type="text" class="form-control"  required ></div>
                <div class="col-4 text-right my-auto orangeText">Celular a 10 dígitos:</div><div class="col-8 my-2"><input name="telefono" type="tel" class="form-control"  required ></div>
                <div class="col-4 text-right my-auto orangeText">
                    Compañia:</div><div class="col-8 my-2">
                    <select class="form-control" name="tsp" id="tsp"  >
                        <option value=""></option>
                        <?php foreach($tsp_s->result() as $tsp):?>
                            <option value="<?=$tsp->tsp_id?>"><?=$tsp->tsp_name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-4 text-right my-auto orangeText">
                    Edad:
                </div>
                <div class="col-8 my-2">
                    
                    <select class="form-control" name="edad" id="edad"  >
                        <option value=""></option>
                        <?php for( $i=18; $i<=99; $i++ ):?>
                            <option value="<?=$i?>"><?=$i?></option>
                        <?php endfor;?>
                    </select>
                </div>
                <div class="col-4 text-right my-auto orangeText">Estado:</div><div class="col-8 my-2">
                    <select class="form-control" name="estado" id="estado"  >
                        <option value=""></option>
                        <?php foreach($states->result() as $state):?>
                            <option value="<?=$state->estado?>"><?=$state->estado?></option>
                        <?php endforeach;?>
                    
                    </select>
                </div>
                <div class="col-4 text-right my-auto orangeText">Delegación/Municipio:</div><div class="col-8 my-2">
                    <select class="form-control" name="delegacion" id="delegacion"  >
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-4 text-right my-auto orangeText">Sexo:</div><div class="col-8 my-2">
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" value="1" name="genero" class="form-check-input" id="genero1">
                    <label class="form-check-label orangeText" for="chkPolitica">Masculino</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="0" name="genero" class="form-check-input" id="genero2">
                    <label class="form-check-label orangeText" for="chkPolitica">Femenino</label>
                </div>
                
                <div class="col-4 text-right my-auto orangeText">Correo:</div><div class="col-8 my-2"><input type="email" class="form-control" name="email"  required ></div>
                <div class="col-4 text-right my-auto orangeText">Crea una Contraseña:</div><div class="col-8 my-2"><input type="password" class="form-control" name="passReg" id="passReg" required ></div>
                <div class="col-4 text-right my-auto orangeText">Confirmar contraseña:</div><div class="col-8 my-2"><input type="password" class="form-control" name="passReg2" id="passReg2" required ></div>
                
                <div class="col-4 text-right my-auto orangeText"></div>
                <div class="col-8 my-2 text-left">
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="form-check-input" id="chkTerminos" name="chkTerminos" >
                    <label class="form-check-label orangeText mousePointer" for="chkTerminos" ><a href="<?=base_url()?>politicas" target="_blank" class="btn_legal_reg" > Acepto términos y condiciones</a></label>
                </div>
                
                <div class="col-4 text-right my-auto orangeText"></div>
                <div class="col-8 my-2 text-left">
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="form-check-input" id="chkPolitica" name="chkPolitica">
                    <label class="form-check-label orangeText mousePointer" for="chkPolitica" ><a href="<?=base_url()?>politicas" target="_blank" class="btn_legal_reg" >Acepto política de privacidad</a></label>
                </div>
                <div class="col-5 mx-auto mt-3">
                    <div id="html_captcha"></div>
                </div>
                <div class="col-12 text-center">
                    <input id="btn_newuser" class="btn_enviar listo-boton" type="image" src="assets/images/btn_entrar.png" alt="Iniciar">
                </div>
            </form>
            
            <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal Recupera -->
    <div class="modal fade" id="recuperaModal" tabindex="-1" role="dialog" aria-labelledby="recuperaModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title ml-auto" id="registroModalLongTitle">Recupera tu contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="assets/images/close.png" />
            </button>
            </div>
            <div class="modal-body">
            
            <form id="f_forget_pass" action="?" method="post" class="row d-flex mt-5">
                
                <div class="col-4 text-right my-auto orangeText">Correo:</div><div class="col-8 my-2"><input type="email" class="form-control" id="email" name="email" required ></div>
                <div class="col-12 text-center">
                    <input id="btn_forgetpass" class="btn_enviar" type="image" src="assets/images/btn_enviar.png" alt="Iniciar">
                </div>
            </form>
            
            <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
            
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal MSG_Contacto -->
    <div class="modal fade" id="contactoMsgModal" tabindex="-1" role="dialog" aria-labelledby="contactoMsgTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body sinFondo">
                <div class="col-12 text-center">
                <img class="msg_contacto" src="assets/images/msg_contacto.png" />
                <img class="btn_inicio ir-inicio-boton" src="assets/images/btn_inicio.png" onclick="self.location.href='<?php echo(base_url()); ?>';" data-dismiss="modal" aria-label="Close" />
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal MSG_No_Valido -->
    <div class="modal fade" id="noValidoMsgModal" tabindex="-1" role="dialog" aria-labelledby="noValidoMsgTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body sinFondo">
                <div class="col-12 text-center">
                <img class="msg_no_valido" src="assets/images/msg_no_valido.png" />
                <img class="btn_regresar regresar-boton-novalido" src="assets/images/btn_regresar.png" onclick="self.location.href='<?php echo(base_url()); ?>';" data-dismiss="modal" aria-label="Close" />
                <img class="btn_otro registrar-otro-novalido" src="assets/images/btn_otro.png" onclick="self.location.href='<?php echo(base_url('codigos')); ?>';" data-dismiss="modal" aria-label="Close" />
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal MSG_Valido -->
    <div class="modal fade" id="validoMsgModal" tabindex="-1" role="dialog" aria-labelledby="validoMsgTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body sinFondo">
                <div class="col-12 text-center">
                <img class="msg_no_valido" src="assets/images/msg_gracias.png" />
                <img class="btn_regresar regresar-boton-valido" src="assets/images/btn_regresar.png" onclick="self.location.href='<?php echo(base_url()); ?>';" data-dismiss="modal" aria-label="Close" />
                <img class="btn_otro otro-boton-valido" src="assets/images/btn_otro.png" onclick="self.location.href='<?php echo(base_url('codigos')); ?>';" data-dismiss="modal" aria-label="Close" />
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal MSG_Cinepolis -->
    <div class="modal fade" id="cinepolisMsgModal" tabindex="-1" role="dialog" aria-labelledby="cinepolisMsgTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body sinFondo">
                <div class="col-12 text-center">
                <img class="msg_no_valido" src="assets/images/msg_cinepolis.png" />
                <img class="btn_regresar instant-regresar-boton" src="assets/images/btn_regresar.png" onclick="self.location.href='<?php echo(base_url()); ?>';" data-dismiss="modal" aria-label="Close" />
                <img class="btn_otro instant-registrar-boton" src="assets/images/btn_otro.png" onclick="self.location.href='<?php echo(base_url('codigos')); ?>';" data-dismiss="modal" aria-label="Close" />
                </div>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal MSG_Amigo -->
    <div class="modal fade" id="amigoMsgModal" tabindex="-1" role="dialog" aria-labelledby="amigoMsgTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body sinFondo">
                <div class="col-12 text-center">
                <div id="container_bonnus"><a href="#" target="_blank" id="url_bonnus">Canjear</a></div>
                <img class="msg_no_valido" src="assets/images/msg_amigo.png" />
                <img class="btn_regresar amigo-regresar-boton" src="assets/images/btn_regresar.png" onclick="self.location.href='<?php echo(base_url()); ?>';" data-dismiss="modal" aria-label="Close" />
                <img class="btn_otro amigo-otro-boton" src="assets/images/btn_otro.png" onclick="self.location.href='<?php echo(base_url('codigos')); ?>';" data-dismiss="modal" aria-label="Close" />
                </div>
            </div>
        </div>
        </div>
    </div>
    
   <!-- Modal Preguntas -->
    <div class="modal fade" id="preguntasModalLong" tabindex="-1" role="dialog" aria-labelledby="preguntasModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title ml-auto" id="exampleModalLongTitle">Preguntas frecuentes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="assets/images/close.png" />
            </button>
            </div>
            <div class="modal-body">
                <?php load_partial("partials/faq")?>
            </div>
        </div>
        </div>
    </div>
    
    
</div>