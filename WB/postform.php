<div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p>Use com moderação.</p>
                <?php if (isset($_POST['submit']) && $statement) : ?>
                    <blockquote>Post enviado. . .</blockquote>
                <?php endif; ?>


                <form method="post">
                    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
                        <label for="message">Digite Aqui seu Texto</label>
                        <div class="row control-group">
                        <div class="form-group col-xs-12">
                            <textarea type="text" name="message" rows="5" class="form-control" placeholder="Message" id="message" ></textarea>
                            <input type="submit" name="submit" value="Enviar">
                        </div>
                        </div>
                        
                </form>
                    <br>
                </form>
                <h4>Enviar imagem.</h4>
                <form method="POST" enctype="multipart/form-data"> 

                <input type="file" name="image" /> 

                <input type="submit" name="ok" value="Enviar Imagem"/> 

                </form>
            </div>
        </div>
    </div>