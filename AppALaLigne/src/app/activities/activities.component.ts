import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-activities',
  templateUrl: './activities.component.html',
  styleUrls: ['./activities.component.scss']
})
export class ActivitiesComponent implements OnInit {

  @Input() activite: string;
  activiteMuscle="musclor";

  constructor() { }

  ngOnInit(): void {
  }

  getMuscle() {
    return this.activiteMuscle;
  }


}
