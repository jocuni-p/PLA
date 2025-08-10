
# README - PLA 07: Gestión Bases de Datos Relacionales



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

<img width="1412" height="725" alt="Captura de pantalla 2025-08-10 a las 11 36 37" src="https://github.com/user-attachments/assets/2d0e0725-044c-4e1e-8e0d-2f017e07e925" />



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
