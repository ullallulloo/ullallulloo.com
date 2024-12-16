---
title: What causes error 0xC0F22213?
game: GeForce NOW
---

GeForce NOW is a popular, honestly really good solution for game streaming. It is generally the most sensible game streaming solution there is, however it can be rather technically finicky. And when there is an error, it just prints an error code to a canvas which you cannot even copy without any explanation why or how to fix it.

One error which is fairly common is error code 0xC0F22213. This indesipherable message is a [timeout error](https://www.nvidia.com/en-us/geforce/forums/gfn-tech-support/46/457061/how-to-fix-error-code-0xcof22213/3095307/#!/pageImmobilier), meaning it took too long for you to connect to the server, so it gave up. In practice, this means that either your Internet connection is way too slow or, more likely, your network is blocking the connection.

Typically, a block like this is caused by your firewall. Even in the browser GeForce NOW uses WebSockets to sign in via port 49100, which is typically not opened on corporate or school networks. If you are receiving this error, you will need to open this port on your firewall to allow GeForce NOW to connect. You should probably also [unblock ports 49003–49006](https://nvidia.custhelp.com/app/answers/detail/a_id/5482/~/how-can-i-adjust-my-network-firewall-to-work-with-geforce-now%3F). Even though Nvidia says this is not necessary when using a web browser, this is clearly not true for the initial connection, so I would expect there to be other ports which need opened as well. If you are getting this error, you can always open the developer tools in your browser and you should see a warning in the console tab about a connection to something like `wss://24-51-23-229.cloudmatchbeta.nvidiagrid.net:[PORT]/` failing. If you see this, you will need to ensure that your firewall is not blocking that port nor the domain itself.
