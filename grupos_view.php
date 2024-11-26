<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Grupos y Alumnos</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    .filtros {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    select {
        flex-grow: 1;
        padding: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <h1>Gestión de Grupos y Alumnos</h1>

    <form method="GET" class="filtros">
        <!-- Selector de Semestre -->
        <select name="semestre" onchange="this.form.submit()">
            <option value="">Selecciona un Semestre</option>
            <?php foreach ($semestres as $id => $nombre): ?>
            <option value="<?= $id ?>" <?= $semestreSeleccionado == $id ? 'selected' : '' ?>>
                <?= $nombre ?>
            </option>
            <?php endforeach; ?>
        </select>

        <!-- Selector de Grupo -->
        <?php if (!empty($grupos)): ?>
        <select name="grupo" onchange="this.form.submit()">
            <option value="">Selecciona un Grupo</option>
            <?php foreach ($grupos as $g): ?>
            <option value="<?= $g['idgrupo'] ?>" <?= $grupoSeleccionado == $g['idgrupo'] ? 'selected' : '' ?>>
                <?= $g['grupo'] ?> - <?= $g['turno'] ?> (<?= $g['carrera'] ?>)
            </option>
            <?php endforeach; ?>
        </select>
        <?php endif; ?>
    </form>

    <!-- Tabla de Alumnos -->
    <?php if (!empty($alumnos)): ?>
    <table>
        <thead>
            <tr>
                <th>No. Control</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>CURP</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnos as $alumno): ?>
            <tr>
                <td><?= htmlspecialchars($alumno['nocontrol']) ?></td>
                <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                <td><?= htmlspecialchars($alumno['appat']) ?></td>
                <td><?= htmlspecialchars($alumno['apmat']) ?></td>
                <td><?= htmlspecialchars($alumno['curp']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</body>

</html>