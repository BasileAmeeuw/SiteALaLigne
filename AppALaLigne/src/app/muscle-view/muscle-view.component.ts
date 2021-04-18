import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-muscle-view',
  templateUrl: './muscle-view.component.html',
  styleUrls: ['./muscle-view.component.scss']
})
export class MuscleViewComponent implements OnInit {

  muscles: any;
  constructor(private http: HttpClient) { }


  ngOnInit(): void {
    this.muscles = this.http.get( "http://127.0.0.1:8000/api/muscle");
  }

}

