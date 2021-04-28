import { Injectable } from '@angular/core';
import { catchError } from 'rxjs/internal/operators';
import { HttpClient, HttpHeaders, HttpErrorResponse} from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { map } from 'rxjs/operators';

const backend="http://127.0.0.1:8000/api/"

export interface Activity {
  id?:string;
  title:string;
  description?:string;
  image?:string;
  duration?:number;
  difficult?:number;
  author?:string;
  material?:string;
  createdAt?:string;
  modifiedAt?:string;
  muscle?:Muscle;
  days?:Day[];
}

export interface Muscle {
  id:string;
  nameOfMuscle:string;
  ExtraExpl:string;
  image:string;
  activities:Activity[];
}

export interface Day {
  id:string;
  date:Date;
  activity:Activity;
}
@Injectable({
  providedIn: 'root'
})
export class RestService {

  constructor(private http:HttpClient) { 

  }

  getActivities(): Observable<any> {
    return this.http.get<Activity>(backend + "activity");
  }

  getActivity(id:string): Observable<any> {
    return this.http.get<Activity>(backend + "activity/" + id);
  }

  getDays(): Observable<any> {
    return this.http.get<Day>(backend + "agenda");
  }

  getMuscles(): Observable<any> {
    return this.http.get<Activity>(backend + "muscle");
  }

  getMuscle(id:string): Observable<any> {
    return this.http.get<Muscle>(backend + "muscle/" + id);
  }

  addActivity(activity:Activity): Observable<any> {
    return this.http.post(backend + "activity", activity);
  }

  addMuscle(): Observable<any> {
    return ;
  }

  addDay(): Observable<any> {
    return ;
  }


  deleteActivity(id:string): Observable<any> {
    return this.http.delete(backend + "activity/" + id);
  }

  deleteMuscle(id:string):Observable<any> {
    return this.http.delete(backend + "muscle/" + id);
  }

  deleteDay(id:string):Observable<any> {
    return this.http.delete(backend + "agenda/" + id);
  }
}
