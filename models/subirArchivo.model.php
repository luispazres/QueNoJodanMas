<?php
  require_once("libs/dao.php");
class Multiupload
{
    /**
    *sube archivos al servidor a trav�s de un formulario
    *@access public
    *@param array $files estructura de array con todos los archivos a subir
    */
    public function upFiles($files = array(),$contratoId)
    {
        //inicializamos un contador para recorrer los archivos
        $i = 0;
        $tamanio="";
        $nombreArchivo="";
        $tipoDocumento="";
        $direccion="";
        //si no existe la carpeta files la creamos
        if(!is_dir("files/"))
            mkdir("files/", 0777);

        //recorremos los input files del formulario
        foreach($files as $file)
        {
            $tamanio= $_FILES["userfile"]["size"][$i];
            $nombreArchivo=$_FILES["userfile"]["name"][$i];
            $tipoDocumento=$_FILES["userfile"]["type"][$i];
            $direccion="files/".$_FILES["userfile"]["name"][$i];
            //si se est� subiendo alg�n archivo en ese indice
            if($_FILES['userfile']['tmp_name'][$i])
            {
                //separamos los trozos del archivo, nombre extension
                $trozos[$i] = explode(".", $_FILES["userfile"]["name"][$i]);

                //obtenemos la extension
                $extension[$i] = end($trozos[$i]);

                //si la extensi�n es una de las permitidas
                if($this->checkExtension($extension[$i]) === TRUE)
                {

                    //comprobamos si el archivo existe o no, si existe renombramos
                    //para evitar que sean eliminados
                    $_FILES['userfile']['name'][$i] = $this->checkExists($trozos[$i]);

                    //comprobamos si el archivo ha subido
                    if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i],"files/".$_FILES['userfile']['name'][$i]))
                    {
                          $strsql = "INSERT INTO tbldocumento
                                      (ContratoCodigo, DocumentoTamanio ,DocumentoNombreArchivo, DocumentoTipo,DocumentoDireccion)
                                     VALUES
                                      ('%d', '%d', '%s','%s','%s');";
                          $strsql = sprintf($strsql, $contratoId,$tamanio,$nombreArchivo,$tipoDocumento,
                                                      $direccion);

                          $resultado=0;
                        $resultado=  ejecutarNonQuery($strsql);
                        return $resultado;

                      //  echo '<script language="javascript">alert("Archivo subido correctamente.");</script>';
                        //aqui podemos procesar info de la bd referente a este archivo
                    }
                //si la extension no es una de las permitidas
                }else{
                  //echo '<script language="javascript">alert("Extension del archivo no permitida");</script>';
                }
            //si ese input file no ha sido cargado con un archivo
            }else{
                //echo '<script language="javascript">alert("Debe seleccionar un archivo.");</script>';
            }
            //echo "<br />";
            //en cada pasada por el loop incrementamos i para acceder al siguiente archivo
            $i++;
        }
    }

    /**
    *funcion privada que devuelve true o false dependiendo de la extension
    *@access private
    *@param string
    *@return boolean - si esta o no permitido el tipo de archivo
    */
    private function checkExtension($extension)
    {
        //aqui podemos a�adir las extensiones que deseemos permitir
        $extensiones = array("pdf");
        if(in_array(strtolower($extension), $extensiones))
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
    *funcion que comprueba si el archivo existe, si es asi, iteramos en un loop
    *y conseguimos un nuevo nombre para el, finalmente lo retornamos
    *@access private
    *@param array
    *@return array - archivo con el nuevo nombre
    */
    private function checkExists($file)
    {
        //asignamos de nuevo el nombre al archivo
        $archivo = $file[0] . '.' . end($file);
        $i = 0;
        //mientras el archivo exista entramos
        while(file_exists('files/'.$archivo))
        {
            $i++;
            $archivo = $file[0]."(".$i.")".".".end($file);
        }
        //devolvemos el nuevo nombre de la imagen, si es que ha
        //entrado alguna vez en el loop, en otro caso devolvemos el que
        //ya tenia
        return $archivo;
    }
}
 ?>
