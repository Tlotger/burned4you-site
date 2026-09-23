import { NextResponse } from "next/server";

type ContactPayload = {
  name?: string;
  email?: string;
  category?: string;
  item?: string;
  message?: string;
  language?: string;
};

const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

export async function POST(request: Request) {
  let body: ContactPayload;
  try {
    body = await request.json();
  } catch {
    return NextResponse.json({ error: "Invalid request body." }, { status: 400 });
  }

  const { name, email, message } = body;

  if (!name?.trim() || !email?.trim() || !message?.trim()) {
    return NextResponse.json({ error: "Name, email, and message are required." }, { status: 400 });
  }

  if (!EMAIL_RE.test(email)) {
    return NextResponse.json({ error: "Please enter a valid email address." }, { status: 400 });
  }

  // TODO: wire this up to a real notification channel before launch, e.g.:
  // - send an email via Resend/Nodemailer to siteConfig.email
  // - or forward to a Slack/Discord webhook
  // - or write to a database once one is introduced
  console.log("New contact form submission:", body);

  return NextResponse.json({ ok: true });
}
