<?php
print_r($_POST);
?>
<div id="criarUsuario" style="display: none;">
    <form method="POST" id="formUsuario" action="../usuario/include/gUsuario.php" autocomplete="off"> 
        <div class="row mb-3">
            <label for="nome" class="col-sm-3 col-form-label form-label">
                Nome completo
            </label>
            <div class="col-sm-9">
                <input id="nome" name="nome" placeholder="Informe seu nome completo" type="text" required class="form-control form-control">
                <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="funcao" class="col-sm-3 col-form-label form-label">
                Data de nascimento:
            </label>
            <div class="col-md-6">
                <!--<label for="datanascimento">Hora Fim: <span style="color: red;">*</span></label>-->
                <input id="datanascimento" name="datanascimento" class="form-control" type="date" />
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-sm-3 col-form-label form-label">
                E-mail
            </label>
            <div class="col-sm-9">
                <input id="email" name="email" placeholder="Digite o email com o '@'" type="email" required class="form-control form-control">
                <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="login" class="col-sm-3 col-form-label form-label">
                Login
            </label>
            <div class="col-sm-9">
                <input id="login" name="login" placeholder="Crie um login" type="text" required class="form-control form-control">
                <div class="invalid-feedback"> <b>Preencha este campo!</b> </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="senha" class="col-sm-3 col-form-label form-label">
                Senha
            </label>
            <div class="col-sm-9">
                <div class="input-group has-validation">
                    <span class="input-group-text pointer" style="width: 43px;" id="olho"> 
                        <i class="fas fa-eye" id="oculta-senha" style="display:none;"></i> 
                        <i class="fas fa-eye-slash" id="mostra-senha"></i>
                    </span>
                    <input id="senha" name="senha" placeholder="Crie uma senha" type="password" class="form-control form-control senha" required>
                    <div class="invalid-feedback">
                        <b class="status-senha">Use 6 caracteres ou mais para sua senha. Contendo caracteres especiais, números, letras maiusculas e minusculas.</b>
                    </div>
                    <div class="valid-feedback">
                        <b class="status-senha">Senha forte!</b>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="confirmasenha" class="col-sm-3 col-form-label form-label">
                Confirme a senha
            </label>
            <div class="col-sm-9">
                <div class="input-group has-validation">
                    <span class="input-group-text pointer" style="width: 43px;" id="olho"> 
                        <i class="fas fa-lock"></i>
                    </span>
                    <input class='form-control senha' id="confirma-senha" onkeyup="confirmaSenha()" name="confirma-senha" type="password" required> 
                    <div class="invalid-feedback is-invalid">
                        <b>Senhas não coincidem!</b>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-9">
                <div class="form-check form-switch mb-3" dir="ltr">
                    <input type="checkbox" class="form-check-input" name="ativo" id="ativo" checked>
                    <label class="form-check-label" for="ativo">Iniciar como ativo?</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-9">
                <div class="form-check form-switch" dir="ltr">
                    <input type="checkbox" class="form-check-input" name="admin" id="admin" >
                    <label class="form-check-label" for="admin">Permissão de administrador?</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-end">
                <button type="button" onclick="validaFormulario('formUsuario')" class="btn btn-success waves-effect waves-light">
                    <i class="bx bx-check-double font-size-16 align-middle me-2"></i> Success
                </button>
            </div>

        </div>
    </form>
</div>