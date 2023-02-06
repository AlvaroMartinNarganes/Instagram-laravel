import Dropzone from "dropzone";
import {value} from "lodash/seq";

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,
    init:function(){
        if(document.querySelector('[name="image"]').value.trim()){
            const image={};
            image.size=1234;
            image.name=document.querySelector('[name="image"]').value;
            this.options.addedfile.call(this,image);
            this.options.thumbnail.call(this,image,`/uploads/${image.name}`)
            image.previewElement.classList.add("dz-success","dz-complete")
        }
    }
})

/*
dropzone.on('sending', (file, xhr, formData) => {
    console.log(file)
})
*/

dropzone.on('success',(file,response)=>{
    document.querySelector('[name="image"]').value=response
})

dropzone.on('removedfile',()=>document.querySelector('[name="image"]').value="")

