```markdown
# README - PLA 07: Gestión Escolar (BD)

## 📚 Qué aprendí

### Diseño de BD Relacional
- Modelé entidades (Profesor, Alumno, Asignatura, Clase) y sus relaciones (1:N, N:M)
- Uso de claves:
  - Primarias (PK)
  - Foráneas (FK) 
  - Únicas (UK)
- Implementé restricciones de integridad:
  - `ON DELETE CASCADE`
  - `ON DELETE RESTRICT`

### Tecnologías utilizadas
- `diagrams.net` para diseño del diagrama ER
- `phpMyAdmin` para implementación en MySQL

## 🛠️ Cómo visualizar el proyecto

### Diagrama Entidad-Relación
1. Accede a [diagrams.net](https://app.diagrams.net/)
2. Menú: `Archivo` → `Importar` → `XML`
3. Selecciona el archivo `colegio.drawio`

### Base de Datos SQL
1. Abre phpMyAdmin
2. Selecciona tu base de datos
3. Ve a la pestaña `Importar`
4. Sube el archivo `colegio.sql`

## 📌 Aspectos clave del diseño
- **Asignaturas**: Código único por curso (ej. MATE1 para Matemáticas 1°)
- **Profesores**: No se pueden eliminar si tienen asignaturas asignadas
- **Alumnos**: Borrado en cascada mantiene el historial
```