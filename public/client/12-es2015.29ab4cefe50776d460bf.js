(window.webpackJsonp=window.webpackJsonp||[]).push([[12],{cPR9:function(t,n,e){"use strict";e.r(n),e.d(n,"NotificationsModule",(function(){return K}));var i=e("ofXK"),s=e("tyNb"),o=e("2Vo4"),a=e("nYR2"),c=e("3E0/"),r=e("0EQZ"),b=e("fXoL"),l=e("LRXf");let d=(()=>{class t{constructor(t){this.http=t}getAll(t){return this.http.get(`notifications/${t}/subscriptions`)}updateUserSubscriptions(t,n){return this.http.put(`notifications/${t}/subscriptions`,{selections:n})}}return t.\u0275fac=function(n){return new(n||t)(b.Yb(l.a))},t.\u0275prov=b.Kb({token:t,factory:t.\u0275fac,providedIn:"root"}),t})();var g=e("twBr"),u=e("i2dy"),p=e("kmQS"),h=e("N2vX"),f=e("3Pt+"),m=e("bTqV"),v=e("bSwM");function P(t,n){if(1&t){const t=b.Vb();b.Ub(0,"div",11),b.Ub(1,"div",12),b.Ic(2),b.Tb(),b.Ub(3,"mat-checkbox",13),b.bc("change",(function(e){b.xc(t);const i=n.$implicit,s=b.fc(3);return e?s.toggleAllRowsFor(i):null})),b.Tb(),b.Tb()}if(2&t){const t=n.$implicit,e=b.fc(3);b.Bb(2),b.Jc(t),b.Bb(1),b.mc("checked",e.allRowsSelectedFor(t))("indeterminate",e.selections[t].hasValue()&&!e.allRowsSelectedFor(t))("disabled","browser"===t&&!e.supportsBrowserNotifications)}}function w(t,n){if(1&t&&(b.Sb(0),b.Gc(1,P,4,4,"div",10),b.Rb()),2&t){const t=b.fc(2);b.Bb(1),b.mc("ngForOf",t.availableChannels)}}function O(t,n){if(1&t){const t=b.Vb();b.Ub(0,"div",11),b.Ub(1,"mat-checkbox",16),b.bc("click",(function(n){return b.xc(t),n.stopPropagation()}))("change",(function(e){b.xc(t);const i=n.$implicit,s=b.fc().$implicit,o=b.fc(2);return e?o.selections[i].toggle(s.notif_id):null})),b.Tb(),b.Tb()}if(2&t){const t=n.$implicit,e=b.fc().$implicit,i=b.fc(2);b.Bb(1),b.mc("checked",i.selections[t].isSelected(e.notif_id))("disabled","browser"===t&&!i.supportsBrowserNotifications)}}function x(t,n){if(1&t&&(b.Ub(0,"div",14),b.Ub(1,"div",15),b.Ic(2),b.Tb(),b.Gc(3,O,2,2,"div",10),b.Tb()),2&t){const t=n.$implicit,e=n.last,i=b.fc(2);b.Fb("no-border",e),b.Bb(2),b.Jc(t.name),b.Bb(1),b.mc("ngForOf",i.availableChannels)}}function y(t,n){if(1&t&&(b.Ub(0,"div",5),b.Ub(1,"div",6),b.Ub(2,"div",7),b.Ic(3),b.Tb(),b.Gc(4,w,2,1,"ng-container",8),b.Tb(),b.Gc(5,x,4,4,"div",9),b.Tb()),2&t){const t=n.$implicit,e=n.first;b.Bb(3),b.Jc(t.group_name),b.Bb(1),b.mc("ngIf",e),b.Bb(1),b.mc("ngForOf",t.subscriptions)}}let k=(()=>{class t{constructor(t,n,e,i,s,a){this.route=t,this.api=n,this.currentUser=e,this.toast=i,this.cd=s,this.settings=a,this.loading$=new o.a(!1),this.supportsBrowserNotifications="Notification"in window,this.availableChannels=[],this.selections={},this.allNotifIds=[]}ngOnInit(){this.route.data.subscribe(t=>{this.subscriptions=t.api.subscriptions,this.availableChannels=t.api.available_channels,this.allNotifIds=t.api.all_notif_ids,this.availableChannels.forEach(n=>{this.selections[n]=new r.b(!0,t.api.selections[n])})}),"granted"!==Notification.permission&&this.bindToBrowserNotifSubscription()}toggleAllRowsFor(t){this.allRowsSelectedFor(t)?this.selections[t].clear():this.selections[t].select(...this.allNotifIds)}allRowsSelectedFor(t){return this.selections[t].selected.length===this.allNotifIds.length}saveSettings(){this.loading$.next(!0);const t=this.getPayload();this.api.updateUserSubscriptions(this.currentUser.get("id"),t).pipe(Object(a.a)(()=>this.loading$.next(!1))).subscribe(()=>{this.toast.open("Notification settings updated.")})}getPayload(){const t={};return Object.keys(this.selections).forEach(n=>{t[n]=this.selections[n].selected}),t}bindToBrowserNotifSubscription(){this.selections.browser.changed.pipe(Object(c.a)(1)).subscribe(t=>{t.added.length&&!t.removed.length&&("denied"===Notification.permission?(this.toast.open("Notifications blocked. Please enable them for this site from browser settings."),this.selections.browser.clear(),this.cd.markForCheck()):Notification.requestPermission().then(t=>{"granted"!==t&&(this.selections.browser.clear(),this.cd.markForCheck())}))})}}return t.\u0275fac=function(n){return new(n||t)(b.Ob(s.a),b.Ob(d),b.Ob(g.a),b.Ob(u.b),b.Ob(b.h),b.Ob(p.a))},t.\u0275cmp=b.Ib({type:t,selectors:[["notification-subscriptions"]],decls:7,vars:5,consts:[[1,"box-shadow",3,"menuPosition"],[1,"be-container"],[1,"table","material-panel",3,"ngSubmit"],["class","setting-group",4,"ngFor","ngForOf"],["mat-raised-button","","color","accent","trans","",1,"submit-button",3,"disabled"],[1,"setting-group"],[1,"row"],["trans","",1,"name-column","strong"],[4,"ngIf"],["class","row indent",3,"no-border",4,"ngFor","ngForOf"],["class","channel-column",4,"ngFor","ngForOf"],[1,"channel-column"],["trans","",1,"channel-name"],[3,"checked","indeterminate","disabled","change"],[1,"row","indent"],["trans","",1,"name-column"],[3,"checked","disabled","click","change"]],template:function(t,n){1&t&&(b.Pb(0,"material-navbar",0),b.Ub(1,"div",1),b.Ub(2,"form",2),b.bc("ngSubmit",(function(){return n.saveSettings()})),b.Gc(3,y,6,3,"div",3),b.Ub(4,"button",4),b.gc(5,"async"),b.Ic(6,"Save Settings"),b.Tb(),b.Tb(),b.Tb()),2&t&&(b.mc("menuPosition",n.settings.get("vebto.navbar.defaultPosition")),b.Bb(3),b.mc("ngForOf",n.subscriptions),b.Bb(1),b.mc("disabled",b.hc(5,3,n.loading$)))},directives:[h.a,f.K,f.v,f.w,i.s,m.b,i.t,v.a],pipes:[i.b],styles:["[_nghost-%COMP%]{display:block;background-color:var(--be-background-alternative);min-height:100vh}.be-container[_ngcontent-%COMP%]{padding-top:35px;padding-bottom:35px}.table[_ngcontent-%COMP%]{border-radius:4px}.setting-group[_ngcontent-%COMP%]{margin-bottom:10px}.row[_ngcontent-%COMP%]{display:flex;align-items:center;border-bottom:1px solid var(--be-divider-default);padding:10px}.row.no-border[_ngcontent-%COMP%]{border-bottom:none}.row.indent[_ngcontent-%COMP%]{padding-left:20px}.name-column[_ngcontent-%COMP%]{flex:1 1 auto}.strong[_ngcontent-%COMP%]{font-weight:500;font-size:1.5rem;align-self:flex-end}.channel-name[_ngcontent-%COMP%]{margin-bottom:10px}.channel-column[_ngcontent-%COMP%]{width:75px;text-align:center;text-transform:capitalize}.submit-button[_ngcontent-%COMP%]{margin-top:15px}"],changeDetection:0}),t})();var C=e("JIr8"),_=e("5+tZ"),U=e("EY2u"),M=e("LRne");let T=(()=>{class t{constructor(t,n,e){this.router=t,this.subscriptions=n,this.currentUser=e}resolve(t,n){return this.subscriptions.getAll(+this.currentUser.get("id")).pipe(Object(C.a)(()=>(this.router.navigate(["/account/settings"]),U.a)),Object(_.a)(t=>t?Object(M.a)(t):(this.router.navigate(["/account/settings"]),U.a)))}}return t.\u0275fac=function(n){return new(n||t)(b.Yb(s.e),b.Yb(d),b.Yb(g.a))},t.\u0275prov=b.Kb({token:t,factory:t.\u0275fac,providedIn:"root"}),t})();var B=e("f+iI"),F=e("OnlV"),$=e("WWJw"),I=e("Rd8u");function N(t,n){if(1&t){const t=b.Vb();b.Ub(0,"li"),b.Ub(1,"button",4),b.bc("click",(function(){b.xc(t);const e=n.$implicit;return b.fc().selectPage(e)})),b.Ic(2),b.Tb(),b.Tb()}if(2&t){const t=n.$implicit,e=b.fc();b.Bb(1),b.Fb("active",e.currentPage===t),b.mc("disabled",e.disabled),b.Bb(1),b.Jc(t)}}let S=(()=>{class t{constructor(t){this.router=t,this.pageChanged=new b.n,this.disabled=!0}get shouldHide(){return this.numberOfPages<2}set pagination(t){t&&(this.numberOfPages=t.last_page>10?10:t.last_page,this.numberOfPages>1&&(this.iterator=Array.from(Array(this.numberOfPages).keys()).map(t=>t+1),this.currentPage=t.current_page))}selectPage(t){this.currentPage!==t&&(this.currentPage=t,this.pageChanged.next(t),this.router.navigate([],{queryParams:{page:t},replaceUrl:!0}))}nextPage(){const t=this.currentPage+1;this.selectPage(t<=this.numberOfPages?t:this.currentPage)}prevPage(){const t=this.currentPage-1;this.selectPage(t>=1?t:this.currentPage)}}return t.\u0275fac=function(n){return new(n||t)(b.Ob(s.e))},t.\u0275cmp=b.Ib({type:t,selectors:[["pagination-widget"]],hostVars:2,hostBindings:function(t,n){2&t&&b.Fb("hidden",n.shouldHide)},inputs:{disabled:"disabled",pagination:"pagination"},outputs:{pageChanged:"pageChanged"},decls:8,vars:3,consts:[[1,"page-numbers","unstyled-list"],["type","button","mat-button","","trans","",1,"prev",3,"disabled","click"],[4,"ngFor","ngForOf"],["type","button","mat-button","","trans","",1,"next",3,"disabled","click"],["type","button","mat-flat-button","","color","gray",1,"page-number-button",3,"disabled","click"]],template:function(t,n){1&t&&(b.Ub(0,"ul",0),b.Ub(1,"li"),b.Ub(2,"button",1),b.bc("click",(function(){return n.prevPage()})),b.Ic(3,"Previous"),b.Tb(),b.Tb(),b.Gc(4,N,3,4,"li",2),b.Ub(5,"li"),b.Ub(6,"button",3),b.bc("click",(function(){return n.nextPage()})),b.Ic(7,"Next"),b.Tb(),b.Tb(),b.Tb()),2&t&&(b.Bb(2),b.mc("disabled",n.disabled),b.Bb(2),b.mc("ngForOf",n.iterator),b.Bb(2),b.mc("disabled",n.disabled))},directives:[m.b,I.a,i.s],styles:["[_nghost-%COMP%]{display:block}ul[_ngcontent-%COMP%]{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;width:100%}li[_ngcontent-%COMP%]{margin:0 3px 6px}.page-number-button[_ngcontent-%COMP%]{width:40px;height:40px;min-width:40px;line-height:40px;padding:0}.active[_ngcontent-%COMP%]{background-color:var(--be-accent-default);color:var(--be-accent-contrast)}.next[_ngcontent-%COMP%], .prev[_ngcontent-%COMP%]{color:var(--be-accent-default)}"],changeDetection:0}),t})();const R=[{path:"",component:(()=>{class t{constructor(t,n,e,i){this.settings=t,this.notifications=n,this.breakpoints=e,this.route=i,this.pagination$=new o.a(null)}ngOnInit(){this.loadPage(this.route.snapshot.queryParams.page||1)}loadPage(t){this.notifications.load({page:t,perPage:25}).subscribe(t=>{this.pagination$.next(t.pagination)})}markAsRead(t){this.pagination$.value.data.find(n=>n.id===t.id).read_at=t.read_at}}return t.\u0275fac=function(n){return new(n||t)(b.Ob(p.a),b.Ob(B.a),b.Ob(F.a),b.Ob(s.a))},t.\u0275cmp=b.Ib({type:t,selectors:[["notification-page"]],decls:8,vars:13,consts:[[3,"menuPosition"],[1,"be-container"],[3,"notifications","compact","markedAsRead"],[3,"pagination","disabled","pageChanged"]],template:function(t,n){if(1&t&&(b.Pb(0,"material-navbar",0),b.Ub(1,"div",1),b.Ub(2,"notification-list",2),b.bc("markedAsRead",(function(t){return n.markAsRead(t)})),b.gc(3,"async"),b.gc(4,"async"),b.Tb(),b.Ub(5,"pagination-widget",3),b.bc("pageChanged",(function(t){return n.loadPage(t)})),b.gc(6,"async"),b.gc(7,"async"),b.Tb(),b.Tb()),2&t){var e;const t=null==(e=b.hc(3,5,n.pagination$))?null:e.data;b.mc("menuPosition",n.settings.get("vebto.navbar.defaultPosition")),b.Bb(2),b.mc("notifications",t)("compact",b.hc(4,7,n.breakpoints.isMobile$)),b.Bb(3),b.mc("pagination",b.hc(6,9,n.pagination$))("disabled",b.hc(7,11,n.notifications.loading$))}},directives:[h.a,$.a,S],pipes:[i.b],styles:["[_nghost-%COMP%]{display:block;min-height:100vh;background-color:var(--be-background-alternative)}.be-container[_ngcontent-%COMP%]{padding-top:25px;padding-bottom:25px}pagination-widget[_ngcontent-%COMP%]{margin-top:35px}"],changeDetection:0}),t})()},{path:"settings",component:k,resolve:{api:T},data:{permissions:["notification.subscribe"]}}];let j=(()=>{class t{}return t.\u0275mod=b.Mb({type:t}),t.\u0275inj=b.Lb({factory:function(n){return new(n||t)},imports:[[s.i.forChild(R)],s.i]}),t})();var A=e("MKyN"),J=e("CXWK"),V=e("gFpt"),E=e("6rvT");let G=(()=>{class t{}return t.\u0275mod=b.Mb({type:t}),t.\u0275inj=b.Lb({factory:function(n){return new(n||t)},imports:[[i.c,m.c,E.a]]}),t})(),K=(()=>{class t{}return t.\u0275mod=b.Mb({type:t}),t.\u0275inj=b.Lb({factory:function(n){return new(n||t)},imports:[[i.c,f.o,f.E,j,V.a,A.a,J.a,G,v.b,m.c]]}),t})()}}]);
//# sourceMappingURL=12-es2015.29ab4cefe50776d460bf.js.map