1. AJAX工作原理
    XMLHttpRequest是Ajax的基础
    XMLHttpRequest用于在后台与服务器交换数据

2.XMLHttpRequest对象请求
    open(method, url, async)
    send(string)

3. XMLHttpRequest对象响应
    (1)responseText
    (2)responseXML
    (3)onreadystatechange:
    readyState: 0(请求未初始化)，1（服务器链接已建立）， 3（请求已接收）
        4（请求已完成，且响应已就绪）
    status: 200, 400

    var xmlhttp;
    function loadXMLDoc(url)
    {
    xmlhttp=null;
    if (window.XMLHttpRequest)
      {// code for all new browsers
      xmlhttp=new XMLHttpRequest();
      }
    else if (window.ActiveXObject)
      {// code for IE5 and IE6
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    if (xmlhttp!=null)
      {
      xmlhttp.onreadystatechange=state_Change;
      xmlhttp.open("GET",url,true);
      xmlhttp.send(null);
      }
    else
      {
      alert("Your browser does not support XMLHTTP.");
      }
    }

    function state_Change()
    {
    if (xmlhttp.readyState==4)
      {// 4 = "loaded"
      if (xmlhttp.status==200)
        {// 200 = OK
        // ...our code here...
        }
      else
        {
        alert("Problem retrieving XML data");
        }
      }
    }

4. jquery Ajax操作
    $(ele).load(), $.ajax(), $.get(), $.post(), $.getJSON(), $.getScript()

