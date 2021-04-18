import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-agenda-view',
  templateUrl: './agenda-view.component.html',
  styleUrls: ['./agenda-view.component.scss']
})
export class AgendaViewComponent implements OnInit {

  days: any;
  constructor(private http: HttpClient) { }

  ngOnInit(): void {
    this.days = this.http.get( "http://127.0.0.1:8000/api/agenda");
  }

}


