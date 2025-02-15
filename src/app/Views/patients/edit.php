<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1>Editar Paciente</h1>
<form action="/patients/update/<?= $patient['id'] ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $patient['name'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $patient['email'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" value="<?= $patient['cpf'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="gender" class="form-label">Genero</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="Homem" <?= $patient['gender'] == 'Homem' ? 'selected' : '' ?>>Homem</option>
            <option value="Mulher" <?= $patient['gender'] == 'Mulher' ? 'selected' : '' ?>>Mulher</option>
            <option value="Outros" <?= $patient['gender'] == 'Outros' ? 'selected' : '' ?>>Outros</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="birth_date" class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?= $patient['birth_date'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="mobile_phone" class="form-label">Celular</label>
        <input type="tel" class="form-control" id="mobile_phone" name="mobile_phone" value="<?= $patient['mobile_phone'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Endereço</label>
        <textarea class="form-control" id="address" name="address"><?= $patient['address'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="medical_history" class="form-label">Histórico Médico</label>
        <textarea class="form-control" id="medical_history" name="medical_history"><?= $patient['medical_history'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar Paciente</button>
</form>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Inputmask({"mask": "999.999.999-99"}).mask(document.getElementById("cpf"));
        Inputmask({"mask": "(99) 9 9999-9999", "placeholder": "(  )   ____-____"}).mask(document.getElementById("mobile_phone"));
    });
</script>
<?= $this->endSection() ?>
