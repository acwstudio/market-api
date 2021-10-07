{{/* vim: set filetype=mustache: */}}
{{/*
Expand the name of the chart.
*/}}
{{- define "dev-env.name" -}}
{{- default .Chart.Name .Values.nameOverride | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "kube-namespace" -}}
{{- printf "%s-%s" .Values.git.tag .Values.git.name | lower | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "ingressDomain" -}}
{{- printf "%s.%s.%s" .Values.git.tag .Values.git.name .Values.devDomain | lower | trunc 255 | trimSuffix "-" -}}
{{- end -}}

{{- define "imagePullSecret" }}
{{- printf "{\"auths\": {\"%s\": {\"auth\": \"%s\"}}}" .Values.imageCred.registry (printf "%s:%s" .Values.imageCred.username .Values.imageCred.password | b64enc) | b64enc }}
{{- end }}

{{/*
Create a default fully qualified app name.
We truncate at 63 chars because some Kubernetes name fields are limited to this (by the DNS naming spec).
If release name contains chart name it will be used as a full name.
*/}}
{{- define "dev-env.fullname" -}}
{{- if .Values.fullnameOverride -}}
{{- .Values.fullnameOverride | trunc 63 | trimSuffix "-" -}}
{{- else -}}
{{- $name := default .Chart.Name .Values.nameOverride -}}
{{- if contains $name .Release.Name -}}
{{- .Release.Name | trunc 63 | trimSuffix "-" -}}
{{- else -}}
{{- printf "%s-%s" .Release.Name $name | trunc 63 | trimSuffix "-" -}}
{{- end -}}
{{- end -}}
{{- end -}}

{{/*
Create chart name and version as used by the chart label.
*/}}
{{- define "dev-env.chart" -}}
{{- printf "%s-%s" .Chart.Name .Chart.Version | replace "+" "_" | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "apps-env-var-values" -}}
{{- $globals := ternary .Values.global.prod .Values.global.dev (eq .Values.global.env_name "prod") -}}
- name: APP_NAME
  value: "Laravel"
- name: APP_ENV
  value: "{{ .Values.global.env_full_name }}"
- name: APP_DEBUG
  value: "{{ $globals.app.debug }}"
- name: APP_KEY
  valueFrom:
    secretKeyRef:
        name: secrets
        key: appKey
- name: APP_URL
  value: https://{{ .Values.global.ci_url }}{{ .Values.global.ci_path | trimSuffix "/" }}
- name: AWS_ACCESS_KEY_ID
  valueFrom:
    secretKeyRef:
        name: secrets
        key: s3AccessKey
- name: AWS_SECRET_ACCESS_KEY
  valueFrom:
    secretKeyRef:
        name: secrets
        key: s3SecretKey
- name: AWS_ENDPOINT
  value: "{{ $globals.s3.endpoint }}"
- name: AWS_BUCKET
  value: "{{ $globals.s3.bucket }}"
- name: DB_CONNECTION
  value: "mysql"
- name: DB_DATABASE
  value: "{{ $globals.mysql.database }}"
- name: DB_HOST
  value: "{{ $globals.mysql.host }}"
- name: DB_PORT
  value: "{{ $globals.mysql.port }}"
- name: DB_USERNAME
  valueFrom:
    secretKeyRef:
      name: secrets
      key: mysqlUser
- name: DB_PASSWORD
  valueFrom:
    secretKeyRef:
      name: secrets
      key: mysqlPassword
- name: MAIL_MAILER
  value: "smtp"
- name: MAIL_HOST
  value: "{{ $globals.mail.host }}"
- name: MAIL_PORT
  value: "{{ $globals.mail.port }}"
- name: MAIL_USERNAME
  value: ""
- name: MAIL_PASSWORD
  value: ""
- name: MAIL_ENCRYPTION
  value: "null"
- name: ELASTICSEARCH_URL
  value: "{{ $globals.elasticsearch.url }}"
{{- end -}}
