//fcm 서버에서 푸시 메시지가 오면 푸시창 띄우기
self.addEventListener("push", function(event) {
  console.log("[Service Worker] Push Received.");

  var response_data = JSON.parse(event.data.text());

  console.log(response_data["notification"]);

  const title = "Push Codelab";
  const options = {
    title: response_data["notification"]["title"],
    body: response_data["notification"]["body"],
    icon: "/2017112803570_0.jpg",
    badge: "/2017112803570_0.jpg"
  };

  event.waitUntil(self.registration.showNotification(title, options));
});

//푸시알림 클릭시 진행하는 이벤트
self.addEventListener("notificationclick", function(event) {
  console.log("[Service Worker] Notification click Received.");
  console.log(event);
  event.notification.close();

  event.waitUntil(clients.openWindow("https://www.naver.com"));
});

console.log("서비스 워커 실행"); //서비스 워커가 실행되는지 확인하는 로그
