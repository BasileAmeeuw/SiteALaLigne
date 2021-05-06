import { Component, OnInit} from '@angular/core';
import { Router } from '@angular/router';
import { RestService, Muscle } from '../services/rest.service';


@Component({
  selector: 'app-muscle',
  templateUrl: './muscle.component.html',
  styleUrls: ['./muscle.component.scss']
})
export class MuscleComponent implements OnInit {

  muscles: Muscle[] = [];
  constructor(public rest: RestService, private router:Router) { }

  muscle:Muscle = {
    id:0,
    nameOfMuscle:"",
    ExtraExpl:"",
    image:""
  }
  id:number;

  ngOnInit(){
    this.getMuscles();
  }


  getMuscles(){
    this.rest.getMuscles().subscribe(
      (response) => {
        console.log(response);
        this.muscles = response}
    );
  }


  detailMuscle( muscle:Muscle){
    this.getMuscles();
    this.muscle=muscle;
    if (this.id==muscle.id) {
      this.id=null;
    } else {
      this.id=muscle.id;
    }
  }

  editMuscle(id:string) {
    this.router.navigateByUrl('/muscleEdit/' + id);
  }

  addMuscle() {
    this.router.navigateByUrl('/muscleAjout');
    this.getMuscles();
  }

  deleteMuscle(id:string){
    this.rest.deleteMuscle(id).subscribe(
      (response) => {
        console.log(response.status)
        if (response.status == 200){
          this.getMuscles();
        } else {
          console.log("probleme avec le delete dans muscle");
        }
      }
    );
  }

  show(id:string){
    this.router.navigateByUrl('/muscleDetail/'+id);
  }

  getLength(array:any[]){
    return array.length;
  }

  getShort(str:string){
    if (str.length>75){
      str=str.slice(0,75)+"..."
    } 
    return str;
  }
}


