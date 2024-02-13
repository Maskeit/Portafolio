import bpy

x = 0
ts = 1
loc_x = 1
loc_y = 0
loc_z = 0
while x < 5:
    bpy.ops.mesh.primitive_cube_add(enter_editmode=False, align='WORLD', location=(loc_x,loc_y,loc_z))
    bpy.ops.transform.resize(value=(ts,ts,ts))
    ts += 0.5
    x = x+1
    loc_x += 3
    loc_y += 2
    loc_z += 1