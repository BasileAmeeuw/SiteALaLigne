import { RestService, Muscle } from '../services/rest.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-muscle-ajout',
  templateUrl: './muscle-ajout.component.html',
  styleUrls: ['./muscle-ajout.component.scss']
})
export class MuscleAjoutComponent implements OnInit {

  muscle:Muscle = {
    "nameOfMuscle":'',
    "ExtraExpl":"",
    "image":""
  }

  constructor(public rest: RestService, private route:ActivatedRoute, private router:Router) { 

  }

  ngOnInit(): void {
    const id = this.route.snapshot.params['id'];
    if (id!=null){
      this.getMuscle(id)
    } else {
      console.log("Add")
    }
  }

  getMuscle(id:string) {
    this.rest.getMuscle(id).subscribe(
      (response) => {
        console.log(response);
        this.muscle= response}
    );
  }

  detailMuscle( id:string){
    this.router.navigateByUrl('/muscleDetail/' + id);
  }

  addMuscle() {
    const id = this.route.snapshot.params['id'];
    if (id!=null){
      this.rest.editMuscle( this.muscle, id).subscribe(
        (response) => {
          console.log(response);
          if (response.id != null) {
            this.detailMuscle(response.id);
          }
        }
      )
    } else {
    this.rest.addMuscle( this.muscle).subscribe(
      (response) => {
        console.log(response);
        if (response.id != null) {
          this.detailMuscle(response.id);
        }
      }
    )}
  }

  back(){
    this.router.navigateByUrl('/muscle');
  }
}
