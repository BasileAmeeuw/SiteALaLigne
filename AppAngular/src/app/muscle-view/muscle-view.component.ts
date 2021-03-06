import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { RestService, Muscle } from '../services/rest.service';


@Component({
  selector: 'app-muscle-view',
  templateUrl: './muscle-view.component.html',
  styleUrls: ['./muscle-view.component.scss']
})
export class MuscleViewComponent implements OnInit {

  muscles: Muscle[] = [];
  constructor(public rest: RestService, private router:Router) { }


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


  detailMuscle( id:number){
    this.router.navigateByUrl('/muscleDetail/' + id);
  }

  editMuscle(id:string) {
    this.router.navigateByUrl('/muscleEdit/' + id);
  }

  addMuscle() {
    this.router.navigateByUrl('/muscleAjout');
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

  getLength(array:any[]){
    return array.length;
  }

  getShort(str:string){
    if (str.length>140){
      str=str.slice(0,140)+"..."
    } 
    return str;
  }
}

