<?php

use Carbon\Carbon;

class ImageController extends BaseController {

  public function addUserPhoto(  $user_id , $photo){

    $input = Input::all();

    $user = User::find( $user_id );

    if(isset($user->photo) && Helpers::isNotOk($user->photo)){

     $destinationPath = Config::get('var.images_dir').Config::get('var.users_dir').$user->id.'/'.Config::get('var.profile_dir');

     $timestamp = Carbon::now()->timestamp;

     File::exists( $destinationPath ) or File::makeDirectory( $destinationPath , 0777, true, true);

     if(Input::hasFile('photo')){
      dd('inputs');

    }elseif(Helpers::isOk( $photo )){

      $filename = sha1($timestamp).'.jpg';

      $image = Image::cache(function( $image ) use($photo, $filename, $destinationPath ){

        return $image->make( $photo )->grab( Config::get('var.user_photo_width') , Config::get('var.user_photo_height') )->save($destinationPath.$filename, 100);

      }, 5, true);

      return $filename;

    }

  }
}

public function logoAgence( $agence_id ){

  $logo = Input::file('logo');

  if(isset($agence_id) && Helpers::isOk($agence_id)){

    $destinationPath = Config::get('var.images_dir').Config::get('var.agences_dir').$agence_id.'/'.Config::get('var.logoAgence_dir');

    $timestamp = Carbon::now()->timestamp;

    File::exists( $destinationPath ) or File::makeDirectory( $destinationPath , 0777, true, true);

    $filename = sha1($timestamp).'.jpg';

    $image = Image::make( $logo )->grab( Config::get('var.agence_logo_width') , Config::get('var.agence_logo_height') )->save($destinationPath.$filename)->encode('jpg', Config::get('var.img_quality'));

    return $filename;

  }

}

public function postBuildingImage( $type='more', $id=null )
{ 

  if(Helpers::isOk( $id ) && Helpers::isOk( $type )){

    $nb_photos = Building::find($id)->photo()->count();

    if( $nb_photos >= Config::get('var.buildingMaxImage') ){

      return Response::json(trans('validation.custom.tooMuchImage'),500);
    }

    $destinationPath = Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.buildings_dir').$id.'/';

    $timestamp = Carbon::now()->timestamp;
  }
  else{

    return Response::json('error', 400);
  } 
  

  File::exists( $destinationPath ) or File::makeDirectory( $destinationPath , 0777, true);

  if(Input::hasFile('file')){

    $file = Input::file('file'); 

                // Declare the rules for the form validation.
    $rules = array('file'  => 'image|max:2000,mimes:jpg,jpeg,gif,png,bmp');

    $data = array('file' => Input::file('file'));

                // Validate the inputs.
    $validator = Validator::make($data, $rules);

    if ($validator->fails())
    { 

     return Response::json($validator->messages(), 400);
   }

   if(is_array($file))
   {  

     foreach($file as $part) {

      $imageType = ImageType::orderBy('width','desc')->get();

      $extension = 'jpg';

      $image = Image::make( Input::file('file')->getRealPath() );

      $photo = new BuildingPhoto;

      $photo->url = $filename;

      $photo->order = $nb_order;

      $photo->type = $type;

      $photo =  Building::find( $id )->photo()->save($photo);

      $filename = Helpers::toSlug(Helpers::addTimestamp( $part->getClientOriginalName(), null, $extension,  $timestamp ));

      $nb_order = Building::find($id)->photo()->whereType($type)->max('order') + 1;

      $image->grab( 2500, 1600 )->save( $destinationPath.$filename )->encode('jpg', Config::get('var.img_quality'));

      foreach( $imageType as $type){

        $filename = Helpers::toSlug(Helpers::addTimestamp( $part->getClientOriginalName(),'-'.$type->name ,$type->extension , $timestamp));

        $image->grab( $type->width, $type->height )->save( $destinationPath.$filename )->encode('jpg', Config::get('var.img_quality'));

      }



    }
  }
else //single file
{   

  $imageType = ImageType::orderBy('width','desc')->get();

  $extension = 'jpg';

  $image = Image::make( Input::file('file')->getRealPath() );

  $filename = Helpers::toSlug(Helpers::addTimestamp( $file->getClientOriginalName(), null, $extension,  $timestamp ));

  $nb_order = Building::find($id)->photo()->whereType($type)->max('order') + 1;

  $photo = new BuildingPhoto;

  $photo->url = $filename;

  $photo->order = $nb_order;

  $photo->type = $type;

  $photo = Building::find( $id )->photo()->save($photo);

  $image->grab( 2500, 1600 )->save( $destinationPath.$filename )->encode('jpg', Config::get('var.img_quality'));

  foreach( $imageType as $type){

    $filename = Helpers::toSlug(Helpers::addTimestamp( $file->getClientOriginalName(),'-'.$type->name ,$type->extension , $timestamp));

    $image->grab( $type->width, $type->height )->save( $destinationPath.$filename )->encode('jpg', Config::get('var.img_quality'));

  }



}

if( Helpers::isOk($image) ) {

  $building = Building::find($id);

  if($building->register_step < 5){

    $building->register_step = 5;  
    $building->save();
  }

  return Response::json('success', 200);

} else {

  return Response::json('error', 400);
}

}else{
  return Response::json('error', 400);
}
}

public function postLocationImage( $type='location', $id=null )
{ 

  if(Helpers::isOk( $id ) && Helpers::isOk( $type )){

    $location = Location::find($id);

    



    $destinationPath = Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').'/'.$id.'/';

    $timestamp = Carbon::now()->timestamp;
  }
  else{

    return Response::json('error', 400);
  } 
  

  File::exists( $destinationPath ) or File::makeDirectory( $destinationPath , 0777, true);

  if(Input::hasFile('file')){

    $file = Input::file('file'); 

                // Declare the rules for the form validation.
    $rules = array('file'  => 'image|max:2000,mimes:jpg,jpeg,gif,png,bmp');

    $data = array('file' => Input::file('file'));

                // Validate the inputs.
    $validator = Validator::make($data, $rules);

    if ($validator->fails())
    { 

     return Response::json($validator->messages(), 400);
   }

   if(is_array($file))
   {  

     foreach($file as $part) {
      $nb_photos = $location->photo()->count();
      if( $nb_photos >= Config::get('var.buildingMaxImage') ){

        return Response::json(array('error'=>trans('validation.custom.tooMuchImage')), 200);
      }

      $imageType = ImageType::orderBy('width','desc')->get();

      $extension = 'jpg';

      $image = Image::make( Input::file('file')->getRealPath() );

      $filename = Helpers::toSlug(Helpers::addTimestamp( $part->getClientOriginalName(), null, $extension,  $timestamp ));

      $nb_order = $location->photo()->max('order') + 1;

      $photo = new PhotoLocation;

      $photo->url = $filename;

      $photo->order = $nb_order;

      $photo =  $location->photo()->save($photo);

      $image->grab( 2500, 1600 )->save( $destinationPath.$filename )->encode('jpg', Config::get('var.img_quality'));

      foreach( $imageType as $type){

        $filename = Helpers::toSlug(Helpers::addTimestamp( $part->getClientOriginalName(),'-'.$type->name ,$type->extension , $timestamp));

        $image->grab( $type->width, $type->height )->save( $destinationPath.$filename )->encode('jpg', Config::get('var.img_quality'));

      }
    }
  }
else //single file
{   
  $nb_photos = $location->photo()->count();
  if( $nb_photos >= Config::get('var.buildingMaxImage') ){

    return Response::json(array('error'=>trans('validation.custom.tooMuchImage')), 200);
  }

  $imageType = ImageType::orderBy('width','desc')->get();

  $extension = 'jpg';

  $image = Image::make( Input::file('file')->getRealPath() );

  $filename = Helpers::toSlug(Helpers::addTimestamp( $file->getClientOriginalName(), null, $extension,  $timestamp ));

  $nb_order = $location->photo()->max('order') + 1;
  
  $photo = new PhotoLocation;

  $photo->url = $filename;

  $photo->order = $nb_order;

  $photo = $location->photo()->save($photo);

  $image->grab( 2500, 1600 )->save( $destinationPath.$filename )->encode('jpg', Config::get('var.img_quality'));

  foreach( $imageType as $type){

    $filename = Helpers::toSlug(Helpers::addTimestamp( $file->getClientOriginalName(),'-'.$type->name ,$type->extension , $timestamp));

    $image->grab( $type->width, $type->height )->save( $destinationPath.$filename )->encode('jpg', Config::get('var.img_quality'));

  }

}

if( Helpers::isOk($image) ) {

  $building = $location->building()->first();

  if($building->register_step < 7){

    $building->register_step = 7;  
    $building->save();
  }

  return Response::json('success', 200);

} else {

  return Response::json('error', 400);
}

}else{
  return Response::json('error', 400);
}
}

public function upatePosition($type){

  if($type === 'location'){

    $class = 'PhotoLocation';

  }elseif($type === 'building'){

    $class = 'BuildingPhoto';

  }
  else{

    $class = 'BuildingPhoto';

  }

  $input = (array)json_decode(key(Input::all()));

  foreach($input as $id => $order){

    $photo = $class::find($id);
    $photo->order = $order; 
    $photo->save();
  }


}

public function postImage( $id )
{

  if(Helpers::isOk( $id )){

    $nb_photos = Propriete::find($id)->photoPropriete()->count();

    if( $nb_photos >= 15 ){

      return Response::json(trans('validation.custom.tropImage'),500);
    }

    $destinationPath = Config::get('var.upload_folder').Auth::user()->id.'/'.Config::get('var.propriete_folder').'/'.$id.'/';

    $timestamp = date('dmYhis');
  } 
  

  File::exists( $destinationPath ) or File::makeDirectory( $destinationPath , 0777, true);

  if(Input::hasFile('file')){

    $file = Input::file('file'); 

                // Declare the rules for the form validation.
    $rules = array('file'  => 'image|max:2000,mimes:jpg,jpeg,bmp');

    $data = array('file' => Input::file('file'));

                // Validate the inputs.
    $validation = Validator::make($data, $rules);

    if ($validation->fails())
    {	
     return Response::json('error', 400);
   }

   if(is_array($file))
   {	

     foreach($file as $part) {

      $imageType = ImageType::orderBy('width','desc')->get();

      $extension = ImageType::where('nom',Config::get('var.image_thumbnail'))->pluck('extension');

      $image = Image::make( Input::file('file')->getRealPath() );

      $filename = Helpers::toSlug(Helpers::addTimestamp( $part->getClientOriginalName(), null, $extension,  $timestamp ));

      $nb_ordre = Propriete::find($id)->photoPropriete()->max('ordre') + 1;

      $photoPropriete = new PhotoPropriete;

      $photoPropriete->url = $filename;

      $photoPropriete->ordre = $nb_ordre;

      $photoPropriete = Propriete::find( $id )->photoPropriete()->save($photoPropriete);

      $image->resize( 1200, 800, true )->save( $destinationPath.$filename );

      foreach( $imageType as $type){

        $filename = Helpers::toSlug(Helpers::addTimestamp( $part->getClientOriginalName(),'-'.$type->nom ,$type->extension , $timestamp));

        $image->resize( $type->width, $type->height, true )->save( $destinationPath.$filename );

      }
    }
  }
else //single file
{   

  $imageType = ImageType::orderBy('width','desc')->get();

  $extension = ImageType::where('nom',Config::get('var.image_thumbnail'))->pluck('extension');

  $image = Image::make( Input::file('file')->getRealPath() );

  $filename = Helpers::toSlug(Helpers::addTimestamp( $file->getClientOriginalName(), null, $extension,  $timestamp ));

  $nb_ordre = Propriete::find($id)->photoPropriete()->max('ordre') + 1;

  $photoPropriete = new PhotoPropriete;

  $photoPropriete->url = $filename;

  $photoPropriete->ordre = $nb_ordre;

  $photoPropriete = Propriete::find( $id )->photoPropriete()->save($photoPropriete);

  $image->resize( 1200, 800, true )->save( $destinationPath.$filename );

  foreach( $imageType as $type){

    $filename = Helpers::toSlug(Helpers::addTimestamp( $file->getClientOriginalName(),'-'.$type->nom ,$type->extension , $timestamp));

    $image->resize( $type->width, $type->height, true )->save( $destinationPath.$filename );

  }

}

if( Helpers::isOk($image) ) {

  $propriete = Propriete::find($id);

  $propriete->etape = Helpers::isOk(Propriete::getCurrentStep()) ? Propriete::getCurrentStep() : 3;

  $propriete->save();

  return Response::json('success', 200);

} else {

	return Response::json('error', 400);
}

}
}

public function deletePhoto( $imageId, $proprieteId , $type){

  $photo = BuildingPhoto::find($imageId);
  
/**
*
* Si la photo existe bien en bdd
*
**/

if( $photo ){

/**
*
* défini le chemin 
*
**/

$destinationPath = public_path(). '/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.buildings_dir').'/'.$proprieteId.'/'.$type.'/';

/**
*
* Choper tous les types d'images
*
**/

$imgTypes = ImageType::all();

/**
*
* Si le fichier de base existe
*
**/

if(File::exists( $destinationPath.$photo->url )){

  /**
  *
  * On le supprime
  *
  **/
  
  File::delete( $destinationPath.$photo->url );

}

/**
*
* La même pour les différents types d'image
*
**/

foreach( $imgTypes as $types ){

  if(File::exists( $destinationPath.Helpers::addBeforeExtension($photo->url, $types->name) )){

    File::delete( $destinationPath.Helpers::addBeforeExtension($photo->url, $types->name) );

  }
}

$photo->delete();

if( $photo ){

  return Response::json('success', 200 );

}
}

}
public function deleteAdvertPhoto( $imageId, $locationId){

  $photo = PhotoLocation::find($imageId);
  
/**
*
* Si la photo existe bien en bdd
*
**/

if( $photo ){

/**
*
* défini le chemin 
*
**/

$destinationPath = public_path(). '/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').'/'.$locationId.'/';

/**
*
* Choper tous les types d'images
*
**/

$imgTypes = ImageType::all();

/**
*
* Si le fichier de base existe
*
**/

if(File::exists( $destinationPath.$photo->url )){

  /**
  *
  * On le supprime
  *
  **/
  
  File::delete( $destinationPath.$photo->url );

}

/**
*
* La même pour les différents types d'image
*
**/

foreach( $imgTypes as $types ){

  if(File::exists( $destinationPath.Helpers::addBeforeExtension($photo->url, $types->name) )){

    File::delete( $destinationPath.Helpers::addBeforeExtension($photo->url, $types->name) );

  }
}

$photo->delete();

if( $photo ){

  return Response::json('success', 200 );

}
}

}
}