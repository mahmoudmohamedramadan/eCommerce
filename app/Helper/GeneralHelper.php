<?php

/**
 *
 *  Save photo if request has photo
 *  @param string $key
 *  @param object $photo
 *  @param string $path
 *  @return string
 */
function savePhoto($key, $photo, $path)
{
    if (request()->has($key)) {
        $photoName = $photo->getClientOriginalName();
        $photo->move($path, $photoName);
        return $photoName;
    }
}

/**
 *
 *  Delete photo if request and model has a photo.
 *  @param string $key
 *  @param object $photo
 *  @param object $model
 *  @return void
 */
function deletePhoto($key, $model, $path)
{
    if (request()->has($key) or request()->isMethod('delete')) {
        if ($model->photo) {
            if (file_exists(public_path($path . $model->photo))) {
                unlink(public_path($path . $model->photo));
            }
        }
    }
}
