function DataManager(){var A=this;A.RequestCompleteEvent=null;this.RequestCompleteEvent=A.RequestCompleteEvent;A.RequestFailedEvent=null;this.RequestFailedEvent=A.RequestFailedEvent;A.Param=null;this.Param=A.Param;this.CreateDataHandler=function(B){var C=function(){if(B.readyState==4){if(B.status==200){A.RequestCompleteEvent(B)}else{A.RequestFailedEvent(B)}}};C.Request=B;C.RequestCompleteEvent=A.RequestCompleteEvent;C.RequestFailedEvent=A.RequestFailedEvent;C.Param=A.Param;return C};this.InitiateXmlHttpRequest=function(){var C=null;try{C=new ActiveXObject("Msxml2.XMLHTTP")}catch(D){try{C=new ActiveXObject("Microsoft.XMLHTTP")}catch(B){C=null}}if(!C&&typeof (XMLHttpRequest)!="undefined"){C=new XMLHttpRequest()}if(!C){alert("Failed to create new ajax request.")}return C};this.LoadData=function(D){var C=this.InitiateXmlHttpRequest();if(C!=null){try{C.onreadystatechange=this.CreateDataHandler(C);C.open("GET",D,true);C.send(null)}catch(B){alert(B)}}}}function HandleFailure(A){alert("Failed: ("+A.status+") "+A.statusText)};