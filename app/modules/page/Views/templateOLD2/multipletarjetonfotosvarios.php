<div class="general-container login-container step3-container">
    <div class="container">
        <div class="row">
            <div class="col-md-7   order-2 order-md-1">
                <div class="row">
                    <div class="col-12">
                        <h3 class="title-one">Proceso electoral</h3>
                    </div>
                    <div class="col-12">
                        <span class="title-two">
                            <strong><?php echo $this->parte1 ?></strong>
                            <br>
                            <span class="big-text green-text" style="margin-top: 10px; display: block;">
                                <?php echo $this->parte2 ?>
                            </span>
                        </span>
                    </div>
                    <div class="col-12">
                        <form action="/page/step3/selectcandidatemultiple" class="row login-form form-multiple" method="post" id="">
                            <div class="grid-container gridmulti-check">
                                <input type="hidden" name="cantidad-maxima" id="cantidad-maxima" value="<?php echo $this->cantidadMaximaVotos ?>">
                                <input type="hidden" name="mostrar-fotos" id="mostrar-fotos" value="<?php echo $this->tarjeton->tarjeton_mostrar_fotos ?>">

                                <?php foreach ($this->candidatos as $key => $c) { ?>
                                    <div class="grid-item">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="checkbox" data-name="<?php echo $c->nombre ?>" name="candidates[]" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>">
                                                <label for="candidate_<?php echo $c->id ?>" class="img-container">
                                                    <?php if ($c->foto) { ?>
                                                        <img src="/images/<?php echo $c->foto ?>" alt="">
                                                    <?php } else { ?>
                                                        <img src="/skins/page/images/user-solid.png" alt="">
                                                    <?php } ?>
                                                </label>
                                            </div>
                                            <div class="content-card">

                                                <div class="col-12 pt-2">
                                                    <span class="number-candidate">
                                                        <span><?php echo $c->numero ?>.</span> <?php echo $c->nombre ?>
                                                    </span>
                                                </div>
                                                <?php if ($this->tarjeton->tarjeton_mostrar_suplente == 1) { ?>

                                                    <div class="col-12 pt-2">
                                                        <span class="number-candidate">
                                                            <?php echo $c->suplente ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($this->tarjeton->tarjeton_mostrar_detalle == 1) { ?>

                                                    <div class="col-12 pt-2">
                                                        <span class="number-candidate">
                                                            <?php echo $c->detalle ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <div class="col-12 py-2">
                                                    <span class="city-candidate">
                                                        <?php echo $this->list_zonas[$c->zona] ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <a class="button back" href="/page/step3/backselection">
                                        <svg height="24" viewBox="0 0 24 24" fill="#FFFF" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path class="heroicon-ui" d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z" />
                                        </svg>
                                        <div class="text">
                                            Volver
                                        </div>
                                    </a>
                                    <button class="button" type="submit">
                                        <div class="text">
                                            Continuar
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-start align-items-center">
                            <img src="/skins/page/images/check.png" alt="">
                            <span class="check-text">
                                Seleccionar un <br>
                                candidato de la lista y
                                hacer click en continuar
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5   order-1 order-md-2">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="info-text">
                            <span class="text-white">
                                Señor asociado, usted se encuentra escrito en la zona de
                                <?php echo $this->zonaInfo->zona ?> a continuación se visualizan los candidatos por los
                                cuales usted podrá ejercer su derecho al voto,
                                <br>
                                <span class="green-text mt-2">
                                    <?php echo $this->tarjeton->tarjeton_descripcion ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end align-items-center">
                            <img src="/skins/page/images/check.png" alt="">
                            <span class="check-text">
                                Ingresar o confirmar el correo electrónico
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <img src="/skins/page/images/num03.png" alt="" class="step-number">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <img src="/images/<?php echo $this->infopage->info_logo_grande ?>" alt="" class="logo-omega">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>