import bpy

#cube = bpy.ops.mesh.primitive_cube_add(enter_editmode=False, align='WORLD', location=(0, 0, 0))
#crear un cubo antes
# Duplicar el objeto seleccionado
bpy.ops.cube.duplicate()

# Obtener la instancia del objeto duplicado
duplicated_cube = bpy.context.active_object

# Posicionar los cubos en forma de cubo 3x3 jejee
for x in range(-1, 2):
    for y in range(-1, 2):
        for z in range(-1, 2):
            if x == 0 and y == 0 and z == 0:
                continue  # Saltar el cubo central
            new_cube = duplicated_cube.copy()
            bpy.context.collection.objects.link(new_cube)
            new_cube.location = (x * duplicated_cube.dimensions.x * 2, y * duplicated_cube.dimensions.y * 2, z * duplicated_cube.dimensions.z * 2)

# transformación para que los objetos duplicados tengan su propia ubicación
bpy.ops.object.transform_apply(location=True)
