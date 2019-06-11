								<?php
								extract($_REQUEST,EXTR_PREFIX_SAME,"v_");
								//echo "<br>REQUEST: <pre>"; var_dump($_REQUEST); echo "</pre>";
								
								if ($estado==NULL) $envio = "0";
								elseif ($estado=="CDMX") $envio = 0;
								else $envio = 120;
								
								$total_producto = $total_pro + $envio;
								?>
								<div class="cart__total" style="font-weight:600">
									<span>Subtotal</span>
									<span>$<?=number_format($total_pro,2,'.',',')?> MXN</span>
								</div>
								<div class="cart__total" style="font-weight:600">				
									<span>Envío</span>
									<span>$<?=number_format($envio,2,'.',',')?> MXN</span>
									<input type="hidden" name="envio" value="<?=$envio?>">
								</div>
								<?php
								if ($estado=="CDMX") {
								?>
								<div class="cart__total" style="font-weight:600">
									<span style="color: #ffffff; background-color: red; font-size: 13px; " class="span_error"> El envío en la CDMX no tiene costo. </span>
								</div>
								<?php
								}
								?>
								<div class="cart__total" style="font-weight:600">
									<span>Total</span>
									<span>$<?=number_format($total_producto,2,'.',',')?> MXN.</span>
									<input type="hidden" name="total_p" value="<?=$total_producto?>">
								</div>