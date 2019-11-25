<div id="cinema-<?php echo $cinema["cinema"]->getId(); ?>" class="dropdown">
                    <span class="selLabel"><p class="showitems__cinema-name--format"><?php echo($cinema["cinema"]->getName()); ?></p></span>
                    <input type="hidden" name="cd-dropdown">
                    <ul class="dropdown-list">
                        <?php foreach($cinema["shows"] as $show) : ?>
                        <li data-value="<?php echo($show->getId()); ?>">
                            <?php $originalDate = $show->getDay();
                            $newDate = str_replace('-','/',date('d-m-Y',strtotime($originalDate)));
                            ?>


                            <div class="showitem__date--container form-group">
                                <div class="showitem__date--inner-container">
                                    <p class="showitem__date--format"><?php echo($newDate); ?> <?php echo($show->getTime()); ?></p><p class="showitem__cinemaroom-name--format"><?php echo($show->getCinemaRoom()->getName()); ?></p>
                                </div>
                                <div class="input-group">
                                    <div class="input-group__form--container">
                                        <div class="input-group-btn">
                                            <button id="down" class="btn btn-default" onclick=" down('0','ticketQuantity-<?php echo($show->getId()); ?>')">-</button>
                                        </div>
                                        <form id="pre-purchase-form" method="POST" action="/funciones/checkout">
                                            <input type="text" hidden style="display:none" name="show_id" value="<?php echo($show->getId()); ?>">
                                            <input type="text" id="ticketQuantity-<?php echo($show->getId()); ?>" name="ticket_quantity" class="form-control ticketQuantity" value="0" />
                                        </form>
                                        <div class="input-group-btn">
                                            <button id="up" class="btn btn-default" onclick="up('<?php echo($show->getCapacityLeft()); ?>','ticketQuantity-<?php echo($show->getId()); ?>')">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a id="pre-purchase-button-<?php echo($show->getId()); ?>" class="pre-button button-disabled showitem__buy--button" href="javascript:void(0)">Comprar</a>
                        </li>



                        <?php endforeach; ?>
                    </ul>
                </div>