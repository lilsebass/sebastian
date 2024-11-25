<nav>
    <ul>
        <li><a href="dashboard.php" class="nav-link">Inicio</a></li>
        <li><a href="alumnos/insertar.php" class="nav-link">Registrar Alumno</a></li>
        <li><a href="alumnos/listar.php" class="nav-link">Listar Alumnos</a></li>
        <li><a href="logout.php" class="nav-link logout">Cerrar Sesión</a></li>
    </ul>
</nav>

<!-- Estilos CSS para el menú -->
<style>
    nav {
        background-color: #4CAF50; /* Color de fondo */
        padding: 10px 0;
        text-align: center;
        border-radius: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    nav ul li {
        display: inline-block;
        margin: 0 20px;
    }
    nav ul li a {
        text-decoration: none;
        font-size: 16px;
        color: white;
        font-weight: bold;
        transition: background-color 0.3s ease, color 0.3s ease;
        padding: 8px 15px;
        border-radius: 5px;
    }
    nav ul li a:hover {
        background-color: #45a049;
        color: white;
    }
    .logout {
        /* background-color: #dc3545; */ /* Color rojo para el botón de cerrar sesión */
    }
    .logout:hover {
        background-color: #c82333;
    }
</style>
