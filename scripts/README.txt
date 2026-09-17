This folder holds helper scripts for running the project. There's just one:

  dev.cmd   Starts the website's dev server (same as running "npm run dev").
            It exists because Node.js isn't always on this Windows machine's
            PATH — this script points straight at where Node.js was
            installed (C:\Program Files\nodejs) before running npm.

You won't normally need to run this yourself — it's used automatically
when the site is previewed. To start the site manually instead, open a
terminal in this project folder and run:

  npm run dev

Then open http://localhost:3000 in a browser.
