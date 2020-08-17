del uploadedfiles\*.* /s /q
del convertedfiles\*.* /s /q
for /d /r %%d in (convertedfiles\*) do @if exist "%%d" rd /s/q "%%d"

