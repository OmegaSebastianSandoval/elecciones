<div class="general-container login-container step3-container">
    <div class="container">
        <div class="row g-0">
            <div class="col-md-8   order-2 order-md-1">
                <div class="row g-0">
                    <div class="col-12">
                        <h3 class="title-one">Proceso electoral </h3>
                    </div>
                    <div class="col-12">
                        <span class="title-two">
                            <strong><?php echo $this->parte1 ?><span class="green-text">
                                    <?php echo $this->parte2 ?>
                                </span></strong>
                            <br>

                        </span>
                    </div>
                    <div class="col-12 mt-3">
                        <form action="/page/step3/selectcandidates" class="row g-0 login-form form-multiple" method="post" id="">
                            <div class="grid-container gridmulti-check">
                                <input type="hidden" name="cantidad-maxima" id="cantidad-maxima" value="<?php echo $this->cantidadMaximaVotos ?>">
                                <input type="hidden" name="mostrar-fotos" id="mostrar-fotos" value="<?php echo $this->tarjeton->tarjeton_mostrar_fotos ?>">

                                <?php foreach ($this->candidatos as $key => $c) { ?>
                                    <div class="grid-item">
                                        <div class="row g-0">
                                            <div class="col-12">

                                                <?php if ($this->cantidadMaximaVotos == 1) { ?>

                                                    <input type="radio" name="candidates[]" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>">

                                                <?php } else { ?>
                                                    <input type="checkbox" data-name="<?php echo $c->nombre ?>" name="candidates[]" id="candidate_<?php echo $c->id ?>" value="<?php echo $c->id ?>">

                                                <?php } ?>
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
                                                    <span class="number-candidate name-candidate">
                                                        <?php echo $c->numero ?>. <?php echo $c->nombre ?>
                                                    </span>
                                                </div>
                                                <div class="col-12 pt-2">
                                                    <span class="number-candidate ">
                                                        <?php echo $c->suplente ?>
                                                    </span>
                                                </div>
                                                <div class="col-12 pt-2">
                                                    <span class="number-candidate">
                                                        <?php echo $c->detalle ?>
                                                    </span>
                                                </div>
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
                                    <!-- <a class="button back" href="/page/step3/backselection">
                                     
                                        <div class="text">
                                            Volver
                                        </div>
                                    </a> -->
                                    <button class="button" type="submit">
                                        <div class="text">
                                            Continuar
                                        </div>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-12 d-none">
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
            <div class="col-md-4   order-1 order-md-2">
                <div class="row fixed-container">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="info-text">
                            <?php if ($this->tarjeton->tarjeton_zona == 1) { ?>
                                <span class="text-white">
                                    Señor asociado, usted se encuentra escrito en la zona de
                                    <?php echo $this->zonaInfo->zona ?> a continuación se visualizan los candidatos por los
                                    cuales usted podrá ejercer su derecho al voto,
                                    <br>
                                    <span class="green-text mt-2">
                                        <?php echo $this->tarjeton->tarjeton_descripcion ?>

                                        Marque un máximo de <?php echo ($this->cantidadMaximaVotos > 1 ?  $this->cantidadMaximaVotos . ' candidatos' : $this->cantidadMaximaVotos . ' candidato') ?>.

                                    </span>
                                </span>
                            <?php } else { ?>
                                <span class="text-white">
                                    PROCESO ELECTORAL FEINCOL<br>
                                    A continuación se visualizan los candidatos por los cuales usted podrá ejercer su derecho al voto.
                                    <span class="green-text mt-2">
                                        <?php echo $this->tarjeton->tarjeton_descripcion ?>
                                        Marque un máximo de <?php echo ($this->cantidadMaximaVotos > 1 ?  $this->cantidadMaximaVotos . ' candidatos' : $this->cantidadMaximaVotos . ' candidato') ?>.
                                    </span>
                                </span>
                            <?php } ?>
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